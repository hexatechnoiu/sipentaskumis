<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ="['"&E7&"','"&D7&"', '"&I7&"', fake()->numberBetween(1000, 9999)],"
     */
    public function run(): void
    {
        $siswa = [
            ['103456789', 'Nasirudin Lukito', '262123007', 'XII PPLG 4'],
            ['123456789', 'Okta Kurniawan', '250007', 'X PM 4'],
            ['012345678', 'Shania Zulaika', '06072008', 'XI MPLB 1'],
        ];

        $data = [];
        foreach ($siswa as $sis) {
            $pwd = rand(1000, 9999);
            $data[] = [
                'name' => ucwords($sis[1]),
                'email' => $sis[0],
                'email_verified_at' => now()->toDateTimeString(),
                'role' => 'Siswa',
                'kelas' => $sis[3],
                'password' => Hash::make($pwd),
                'sandi' => $pwd,
                'remember_token' => Str::random(10),
            ];
        }

        DB::table('users')->insert($data);
    }
}
