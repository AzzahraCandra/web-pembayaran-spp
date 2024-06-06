<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userName = Auth::user()->name;
            $userLevel = Auth::user()->level;

            if ($userLevel == 'admin') {
                return redirect()->route('main-page')->with('success', "Anda Berhasil Login. Selamat Datang $userName.");
            } elseif ($userLevel == 'bendahara') {
                return redirect()->route('bendahara-page')->with('success', "Anda Berhasil Login. Selamat Datang $userName.");
            } elseif ($userLevel == 'kepsek') {
                return redirect()->route('kepsek-page')->with('success', "Anda Berhasil Login. Selamat Datang $userName.");
            } else {
                return redirect()->route('home')->with('success', "Anda Berhasil Login. Selamat Datang $userName.");
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
