<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoteController extends Controller
{
    public function osis()
    {
        // Dapatkan semua kandidat OSIS kemudian sajikan dengan view
        return view('vote', [
            'kandidat' => Kandidat::where('org', 'OSIS')->orderBy('nomor_urut', 'asc')->get(),
            'org_name' => 'OSIS',
        ]);
    }

    public function mpk(Request $request)
    {
        // Lakukan cek bila tidak ada OSIS maka alihkan ke halaman vote OSIS
        if (! $request->has('osis') || empty($request->input('osis'))) {
            return redirect()->route('vote.osis');
        }

        return view('vote', [
            'kandidat' => Kandidat::where('org', 'MPK')->orderBy('nomor_urut', 'asc')->get(),
            'org_name' => 'MPK',
        ]);
    }

    public function confirm_vote(Request $request)
    {
        // Lakukan cek bila tidak ada OSIS maka alihkan ke halaman vote OSIS
        if (! $request->has('osis')) {
            return redirect()->route('vote.osis');
        }

        // Lakukan cek bila tidak ada MPK maka alihkan ke halaman vote MPK
        if (! $request->has('mpk')) {
            return redirect()->route('vote.mpk');
        }

        // Cek apakah value ada dan valid
        $osisId = $request->input('osis');
        $mpkId = $request->input('mpk');

        $osisCandidate = Kandidat::where('org', 'OSIS')->findOrFail($osisId);
        $mpkCandidate = Kandidat::where('org', 'MPK')->findOrFail($mpkId);

        // Tampilkan halaman konfirmasi suara
        return view('confirm_page', [
            'osis' => $osisCandidate,
            'mpk' => $mpkCandidate,
        ]);
    }

    public function submit(Request $req)
    {
        try {
            $user = auth()->user();

            // Periksa apakah pengguna sudah memilih untuk OSIS atau MPK
            if ($user->vote->where('organisasi', 'OSIS')->count() > 0) {
                return redirect()->route('vote.osis')->with('error', 'Anda sudah memilih untuk OSIS.');
            }

            if ($user->vote->where('organisasi', 'MPK')->count() > 0) {
                return redirect()->route('vote.mpk')->with('error', 'Anda sudah memilih untuk MPK.');
            }

            // Buat entri vote untuk OSIS dan MPK
            Vote::create([
                'user_id' => $user->id,
                'kandidat_id' => $req->osis,
                'organisasi' => 'OSIS',
            ]);

            Vote::create([
                'user_id' => $user->id,
                'kandidat_id' => $req->mpk,
                'organisasi' => 'MPK',
            ]);

            return view('berhasil');
        } catch (\Throwable $th) {
            // Tangani pengecualian dengan lebih spesifik, misalnya:
            Log::error('Error occurred during vote submission: '.$th->getMessage());

            return redirect()->route('gagal')->with('error', 'Terjadi kesalahan saat memproses suara Anda.');
        }
    }
}
