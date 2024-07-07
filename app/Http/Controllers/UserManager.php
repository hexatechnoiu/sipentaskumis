<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManager extends Controller
{
    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users,email',
            'token' => 'required|min:4',
        ];

        $credential = $request->validate($rules);
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('token'),
        ], true)) {
            $request->session()->regenerate();

            return redirect(route('vote.osis'));
        }

        return redirect()->back()->with('kesalahan', 'Token yang Anda masukkan salah. Silahkan coba lagi atau hubungi panitia');
    }

    public function authenticateAdmin(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:4',
        ];

        $credential = $request->validate($rules);
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect(route('dashboard.home'));
        }

        return redirect()->back()->with('kesalahan', 'Sandi yang Anda masukkan salah. Silahkan coba lagi');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route('home'));
    }
}
