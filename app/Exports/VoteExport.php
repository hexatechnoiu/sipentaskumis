<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoteExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'NIP/NIPD',
            'Kelas',
            'MPK',
            'OSIS',
        ];
    }

    public function collection()
    {
        config(['database.connections.mysql.strict' => false]);
        DB::reconnect();
        $uvotes = User::whereHas('votes', function ($query) {
            $query->whereIn('organisasi', ['OSIS', 'MPK'])
                ->groupBy('user_id')
                ->havingRaw('COUNT(*) = 2');
        })->with(['votes:nomor_urut,name,organisasi'])->get();
        config(['database.connections.mysql.strict' => true]);
        DB::reconnect();

        $exportData = [];

        foreach ($uvotes as $u) {
            $data['id'] = $u->id;
            $data['name'] = $u->name;
            $data['email'] = $u->email;
            $data['kelas'] = $u->kelas;
            $data['MPK'] = '';
            $data['OSIS'] = '';

            foreach ($u->votes as $kandidat) {
                if ($kandidat->organisasi == 'MPK') {
                    $data['MPK'] = $kandidat->name;
                } elseif ($kandidat->organisasi == 'OSIS') {
                    $data['OSIS'] = $kandidat->name;
                }
            }

            $exportData[] = $data;
        }

        return collect($exportData);
    }
}
