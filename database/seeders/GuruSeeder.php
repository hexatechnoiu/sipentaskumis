<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $persons =
            [
                [3211000000000000, 'Dra. Nama Kepala Sekolah, M.Pd.', '1443', '02021967', 'Kepala Sekolah'],
                [3211000000000000, 'Dra. Nama Wakases, M.Pd.', '1443', '02021967', 'Wakasek Kurikulum'],
            ];
        foreach ($persons as $p) {
            DB::table('users')->insert(
                [
                    'name' => $p[1],
                    'email' => $p[0],
                    'email_verified_at' => now()->toDateTimeString(),
                    'role' => $p[4],
                    'password' => Hash::make($p[2]),
                    'sandi' => $p[2],
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
