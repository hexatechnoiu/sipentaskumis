<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManager;
use App\Http\Controllers\VoteController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('export', [DashboardController::class, 'export'])->name('export-excel');

    Route::middleware('guest')->prefix('login')->name('login.')->group(function () {
        Route::get('admin', function () {
            return view('auth.admin_login');
        })->name('admin');

        Route::post('authenticate-admin', [UserManager::class, 'authenticateAdmin'])->name('authenticate-admin');
    });

    Route::post('logout', [UserManager::class, 'logout'])->name('logout')->middleware('auth');

    Route::middleware(['auth', 'IsAdmin'])->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('home', [DashboardController::class, 'index'])->name('home');
        Route::get('voted', [DashboardController::class, 'voted'])->name('voted');
        Route::get('notvoted', [DashboardController::class, 'notvoted'])->name('notvoted');
        Route::get('result', [DashboardController::class, 'result'])->name('result');
        Route::get('result/print', [DashboardController::class, 'print_result'])->name('print_result');
        Route::get('users', [DashboardController::class, 'users'])->name('users');
        Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
        Route::post('user/store', [DashboardController::class, 'store_users'])->name('store_users');

        Route::get('kandidat', [DashboardController::class, 'kandidat'])->name('kandidat');
        Route::post('kandidat/store', [DashboardController::class, 'store_kandidat'])->name('store_kandidat');
        Route::delete('kandidat/delete/{kandidat}', [DashboardController::class, 'destroy_kandidat'])->name('destroy_kandidat');
        Route::patch('kandidat/update/{kandidat}', [DashboardController::class, 'update_kandidat'])->name('update_kandidat');

        Route::delete('users/delete/{id}', [DashboardController::class, 'destroy_users'])->name('delete_users');
        Route::put('users/update/{id}', [DashboardController::class, 'update_users'])->name('update_users');
        Route::put('settings/update', [DashboardController::class, 'update_settings'])->name('update_settings');
        Route::post('guru/import', [DashboardController::class, 'importExcel'])->name('import.excel');
    });

    Route::get('dashboard/data_source', [DashboardController::class, 'ajax']);
});

// User Route
Route::get('closed', fn() => view('vote_closed'))->name('vote_closed');

Route::middleware('IsVotingAllowed')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::prefix('login')->name('login.')->group(function () {
        Route::get('siswa', function () {
            $siswa = User::where('role', 'Siswa')->get();

            return view('auth.login', [
                'users' => $siswa,
                'header_text' => 'Login Siswa',
                'image' => asset('img/siswa.webp'),
                'username_text' => 'Masukkan NIS atau Nama Anda',
                'text_input_name' => 'NIS | NAMA | KELAS',
                'password_text' => 'Sandi',
            ]);
        })->name('siswa')->middleware('guest');

        Route::get('guru', function () {
            $guru = User::whereNotIn('role', ['Siswa', 'Admin'])->get();

            return view('auth.login', [
                'users' => $guru,
                'header_text' => 'Login Guru dan Tenaga Kependidikan',
                'image' => asset('img/guru.webp'),
                'username_text' => 'Masukkan NIK atau Nama Anda',
                'text_input_name' => 'JABATAN | NAMA',
                'halaman' => 'guru',
                'password_text' => 'Sandi',
            ]);
        })->name('guru')->middleware('guest');

        Route::post('authenticate', [UserManager::class, 'authenticate'])->name('authenticate')->middleware('guest');
    });

    Route::middleware(['auth', 'IsUser', 'IsVoted'])->prefix('vote')->name('vote.')->group(function () {
        Route::get('osis', [VoteController::class, 'osis'])->name('osis');
        Route::get('mpk', [VoteController::class, 'mpk'])->name('mpk');
        Route::get('confirm', [VoteController::class, 'confirm_vote'])->name('confirm_vote');
        Route::post('submit', [VoteController::class, 'submit'])->name('submit');
    });

    Route::get('login', function () {
        return redirect()->route('home');
    })->name('login');

    Route::get('berhasil', function () {
        return view('berhasil');
    })->name('berhasil');

    Route::middleware('auth')->get('gagal', function () {
        return view('gagal');
    })->name('gagal');
});
