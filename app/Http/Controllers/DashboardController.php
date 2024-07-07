<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Exports\SiswaExport;
use App\Exports\VoteExport;
use App\Imports\GurusImport;
use App\Imports\SiswasImport;
use App\Models\Config;
use App\Models\Kandidat;
use App\Models\User;
use App\Models\Vote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function update_settings(Request $request)
    {
        foreach ($request->keys() as $key) {
            if ($key != '_token' && $key != '_method') {
                $value_from_request = $request->get($key);
                $value_from_cache_or_db = cache('settings')[$key]['value'];
                if ($value_from_request != $value_from_cache_or_db) {
                    Config::where('key', $key)->update(['value' => $value_from_request]);
                    Cache::forget('settings');
                    cache()->remember(
                        'settings',
                        60 * 5,
                        fn () => Config::all()->keyBy('key'),
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    public function index()
    {
        $osis = Kandidat::where('org', 'OSIS')->withCount('vote')->get();
        $mpk = Kandidat::where('org', 'MPK')->withCount('vote')->get();

        return view(
            'dashboard.index',
            [
                'allusers' => DB::table('users')->whereNot('role', 'Admin')->count(),
                'kandidats' => DB::table('kandidats')->count(),
                'notvoted' => DB::table('users')->whereNot('role', 'Admin')->leftJoin('votes', 'users.id', '=', 'votes.user_id')->whereNull('votes.user_id')->count(),
                'voted' => DB::table('votes')->where('organisasi', 'OSIS')->count(),
                'osis' => collect($osis),
                'mpk' => collect($mpk),
                'unsorted_osis' => collect($osis)->sortBy('nomor_urut'),
                'unsorted_mpk' => collect($mpk)->sortBy('nomor_urut'),
            ]
        );
    }

    public function kandidat()
    {
        $kandidats = Kandidat::get();
        if (request('search')) {
            $kandidats = Kandidat::where('name', 'LIKE', '%'.request('search').'%')
                ->orWhere('nomor_urut', 'LIKE', '%'.request('search').'%')
                ->orWhere('org', 'LIKE', '%'.request('search').'%')
                ->get();
        }

        return view(
            'dashboard.calon',
            [
                'kandidats' => collect($kandidats),
            ]
        );
    }

    public function users()
    {
        // $users = User::whereNot('role', 'Admin')->paginate(30);
        $users = User::paginate(50)->withQueryString();
        if (request('search')) {
            $users = User::where('name', 'LIKE', '%'.request('search').'%')
                ->orWhere('role', 'LIKE', '%'.request('search').'%')
                ->orWhere('kelas', 'LIKE', '%'.request('search').'%')
                ->orWhere('email', 'LIKE', '%'.request('search').'%')
                ->paginate(50)->withQueryString();
        }

        return view(
            'dashboard.users',
            [
                'users' => $users,
                'role' => DB::table('users')->select('role')->orderBy('role')->distinct()->pluck('role')->all(),
                'kelas' => DB::table('users')->select('kelas')->orderBy('kelas')->distinct()->pluck('kelas')->all(),
            ]
        );
    }

    public function voted()
    {
        // config(['database.connections.mysql.strict' => false]);
        // DB::reconnect();
        // $user_votes = User::whereHas('vote', function ($query) {
        //     $query->whereIn('organisasi', ['OSIS', 'MPK'])
        //         ->groupBy('user_id')
        //         ->havingRaw('COUNT(*) = 2');
        // })->with(['votes:nomor_urut,name,organisasi'])->get();
        $user_votes = User::whereHas('vote', function ($query) {
            $query->whereIn('organisasi', ['OSIS', 'MPK'])
                ->groupBy('user_id');
        })->with(['votes'])->get();

        // config(['database.connections.mysql.strict' => true]);
        // DB::reconnect();
        return view(
            'dashboard.sudah_vote',
            [
                'voted' => $user_votes,
            ]
        );
    }

    public function notvoted()
    {

        $not_voted = User::whereNot('role', 'Admin')->leftJoin('votes', 'users.id', '=', 'votes.user_id')->whereNull('votes.user_id')->get();

        return view(
            'dashboard.belum_vote',
            [
                'notvoted' => $not_voted,
            ]
        );
    }

    public function result()
    {
        $osis = Kandidat::where('org', 'OSIS')->withCount('vote')->orderBy('vote_count', 'desc')->get();
        $mpk = Kandidat::where('org', 'MPK')->withCount('vote')->orderBy('vote_count', 'desc')->get();

        return view('dashboard.hasil', [
            'osis' => $osis,
            'mpk' => $mpk,
            'new_role' => ['Ketua Umum', 'Ketua 1', 'Ketua 2', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara 1', 'Bendahara 2'],
        ]);
    }

    public function print_result()
    {
        $data['osis'] = Kandidat::where('org', 'OSIS')->withCount('vote')->orderBy('vote_count', 'desc')->get();
        $data['mpk'] = Kandidat::where('org', 'MPK')->withCount('vote')->orderBy('vote_count', 'desc')->get();
        $data['new_role'] = ['Ketua Umum', 'Ketua 1', 'Ketua 2', 'Sekretaris 1', 'Sekretaris 2', 'Bendahara 1', 'Bendahara 2'];
        $pdf = Pdf::loadView('dashboard.print.hasil', $data);

        return $pdf->stream('hasil_vote.pdf');
    }

    public function settings()
    {
        return view('dashboard.settings', [
            'settings' => Config::get(),
        ]);
    }

    public function store_users(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'kelas' => 'nullable',
            'password' => 'required',
        ];
        $data = $request->validate(
            $rules
        );
        $data['sandi'] = $data['password'];
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->back()->with('success', 'Berhasil menambahkan pengguna');
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:guru,siswa,kandidat',
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {
            $type = $request->input('type');
            $file = $request->file('file');

            switch ($type) {
                case 'guru':
                    Excel::import(new GurusImport, $file);

                    return redirect()->back()->with(['success' => 'Guru berhasil di import']);
                case 'siswa':
                    Excel::import(new SiswasImport, $file);

                    return redirect()->back()->with(['success' => 'Siswa berhasil di import']);
                default:
                    return redirect()->back()->with(['error' => 'Invalid type selected']);
            }
        }

        return redirect()->back()->with(['error' => 'No file selected']);
    }

    public function store_kandidat(Request $request)
    {
        $rules = [
            'name' => 'required',
            'nomor_urut' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'org' => 'exists:kandidats,org',
            'motto' => 'nullable',
            'visi' => 'nullable',
            'misi' => 'nullable',
        ];

        $data = $request->validate(
            $rules
        );
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data['photo'] = $request->file('photo')->store('kandidat', 'public');
        }
        $kandidat = Kandidat::create($data);

        return redirect()->back()->with('success', 'Berhasil menambahkan kandidat '.$kandidat->name);
    }

    public function update_kandidat(Kandidat $kandidat, Request $request)
    {
        $rules = [
            'name' => 'required',
            'nomor_urut' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'org' => 'exists:kandidats,org',
            'motto' => 'nullable',
            'visi' => 'nullable',
            'misi' => 'nullable',
        ];

        $data = $request->validate($rules);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data['photo'] = $request->file('photo')->store('kandidat', 'public');
        } else {
            $data['photo'] = $kandidat->photo;
        }
        $kandidat->updateOrFail($data);

        return redirect()->back()->with('success', "Berhasil mengubah kandidat '$kandidat->name' ");
    }

    public function destroy_kandidat(Kandidat $kandidat)
    {
        $kandidat->delete();

        return redirect()->back()->with('success', ' Berhasil menghapus data');
    }

    public function destroy_users()
    {
        User::destroy(request('id'));

        return redirect()->back()->with('success', ' Berhasil menghapus data');
    }

    public function update_users(Request $request)
    {
        $trueData = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'kelas' => 'nullable',
            'password' => 'required',
            'role' => 'required',
        ]);
        $trueData['sandi'] = $trueData['password'];
        $trueData['password'] = Hash::make($trueData['password']);
        User::where('id', request('id'))->update($trueData);

        return redirect()->back()->with('success', ' Berhasil mengubah data');
    }

    public function ajax()
    {
        try {
            $osis = Kandidat::where('org', 'OSIS')->withCount('vote')->get();
            $mpk = Kandidat::where('org', 'MPK')->withCount('vote')->get();
            $leaderboard = view('components.leaderboard', ['osis' => $osis, 'mpk' => $mpk])->render();
            $data = [
                'allusers' => DB::table('users')->whereNot('role', 'Admin')->count(),
                'kandidats' => DB::table('kandidats')->count(),
                'notvoted' => DB::table('users')->whereNot('role', 'Admin')->leftJoin('votes', 'users.id', '=', 'votes.user_id')->whereNull('votes.user_id')->count(),
                'voted' => DB::table('votes')->where('organisasi', 'OSIS')->count(),
                'unsorted_osis' => collect($osis)->sortBy('nomor_urut')->values()->all(),
                'unsorted_mpk' => collect($mpk)->sortBy('nomor_urut')->values()->all(),
                'leaderboard' => $leaderboard,
            ];

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th, 505);
        }
    }

    public function export()
    {
        switch (request('tipe')) {
            case 'guru':
                $fileName = 'Token guru.xlsx';

                return Excel::download(new GuruExport(), $fileName);
            case 'siswa':
                $fileName = 'Token siswa.xlsx';

                return Excel::download(new SiswaExport(), $fileName);
            case 'vote':
                $fileName = 'Hasil vote.xlsx';

                return Excel::download(new VoteExport(), $fileName);
            default:
                abort(404);
                break;
        }
    }
}
