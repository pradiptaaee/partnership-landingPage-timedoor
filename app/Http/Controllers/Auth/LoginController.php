<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session ;
// use Illuminate\Support\Facades\Session as FacadesSession;


class LoginController extends Controller
{
    // Tampilkan formulir login admin
    public function showLoginForm()
    {
        // Jika user sudah login, arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.partners.index');
        }

        return view('auth.login');
    }

    // Proses login (Handling POST request)
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            // Asumsi input menggunakan 'username' atau 'email'
            'username_or_email' => 'required|string',
            'password' => 'required',
        ]);

        // Tentukan field yang digunakan (email atau username)
        $loginType = filter_var($request->input('username_or_email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        $data = [
            $loginType => $request->input('username_or_email'),
            'password' => $request->input('password')
        ];

        // 2. Coba proses otentikasi
        if (Auth::attempt($data, $request->boolean('remember'))) {

            // Re-generate session ID untuk mencegah session fixation
            $request->session()->regenerate();

            Session::flash('login_success', 'Selamat datang kembali! Anda berhasil login.');
            // Otentikasi berhasil, arahkan ke halaman dashboard admin
            return redirect()->intended(route('admin.partners.index'));
        }

        // 3. Otentikasi gagal
        return back()->withErrors([
            'username_or_email' => 'Kombinasi username/email dan password tidak cocok.',
        ])->onlyInput('username_or_email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('login');
    }
}