<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Jabatan',
            'Nama',
            'Token',
        ];
    }

    public function collection()
    {
        $usersData = DB::table('users')->select(['role', 'name', 'sandi'])->whereNot('role', 'Admin')->whereNot('role', 'Siswa')->get();

        return collect($usersData);
    }
}
