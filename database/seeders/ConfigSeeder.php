<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configs')->insert(
            [
                'key' => 'is_voting_ended',
                'value' => 'false',
                'type' => 'boolean',
            ]
        );
        DB::table('configs')->insert(
            [
                'key' => 'voting_angkatan',
                'value' => '2023/2024',
                'type' => 'text',
            ]
        );
    }
}
