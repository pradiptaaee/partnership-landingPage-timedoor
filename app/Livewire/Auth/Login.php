<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    // Properti untuk mengikat data dari form
    public $username_or_email = '';
    public $password = '';
    public $remember = false;

    // Aturan validasi (sama dengan yang ada di Controller)
    protected $rules = [
        'username_or_email' => 'required|string',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate(); // Jalankan validasi rules di atas

        // Tentukan field login (email atau username)
        $loginType = filter_var($this->username_or_email, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name'; // Asumsi jika bukan email, menggunakan 'name' atau 'username'

        $credentials = [
            $loginType => $this->username_or_email,
            'password' => $this->password
        ];

        // Coba otentikasi
        if (Auth::attempt($credentials, $this->remember)) {

            session()->regenerate();

            // Redirect ke dashboard admin setelah login sukses
            return redirect()->intended(route('admin.partners.index'));

        } else {
            // Jika otentikasi gagal, tampilkan error
            $this->addError('username_or_email', 'Kombinasi username/email dan password tidak cocok.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}