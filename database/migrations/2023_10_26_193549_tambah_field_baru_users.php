<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nisn_nip')->nullable();
            $table->enum('role', ['Admin', 'Siswa', 'Guru', 'Tenaga Kependidikan', 'Kepala Sekolah', 'Guru BK', 'Wakasek Kurikulum', 'Wakasek Kesiswaan', 'Wakasek Hubin', 'Wakasek Sarpras', 'Kaprog PPLG', 'Kaprog AKL', 'Kaprog MPLB', 'Kaprog PM'])->default('Siswa');
            $table->string('kelas')->nullable();
            $table->string('sandi')->nullable()->default('‎');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
