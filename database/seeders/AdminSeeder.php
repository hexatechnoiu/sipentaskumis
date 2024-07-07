<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            ['Administrator', 'admin@gmail.com', 'chocolatos'],
            ['Developer', 'dev@gmail.com', 'lezatos'],
            ['OSIS & MPK', 'osismpk@gmail.com', 'mpkosis'],
        ];

        foreach ($admins as $admin) {
            DB::table('users')->insert(
                [
                    'name' => $admin[0],
                    'email' => $admin[1],
                    'email_verified_at' => now(),
                    'role' => 'Admin',
                    'password' => Hash::make($admin[2]),
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
