<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index');
            }else{
                return redirect()->intended('dashboard');
            }
        } else {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }
    }

    // Tampilkan dashboard setelah login
    public function dashboard()
    {
        return view('dashboard');
    }


    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
