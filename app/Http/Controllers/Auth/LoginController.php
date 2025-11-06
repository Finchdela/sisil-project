<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // DEBUG: Tampilkan credentials (hapus setelah fix)
        \Log::info('Login attempt', ['email' => $credentials['email']]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // DEBUG: Tampilkan user yang login (hapus setelah fix)
            \Log::info('Login successful', [
                'user_id' => Auth::id(), 
                'user_name' => Auth::user()->name,
                'user_role' => Auth::user()->role
            ]);

            return redirect()->intended('/home');
        }

        // DEBUG: Tampilkan gagal login (hapus setelah fix)
        \Log::warning('Login failed', ['email' => $credentials['email']]);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}