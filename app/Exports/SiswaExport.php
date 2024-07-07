<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'NIPD',
            'Nama',
            'Token',
        ];
    }

    public function collection()
    {
        $usersData = DB::table('users')->select(['email', 'name', 'sandi'])->whereNot('role', 'Admin')->where('role', 'Siswa')->get();

        return collect($usersData);
    }
}
