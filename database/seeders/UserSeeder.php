<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk user Admin
        User::create([
            'name' => 'Super Admin',
            // Ganti email ini dengan email yang ingin Anda gunakan
            'email' => 'admin@timedoor.com',
            // Tambahkan kolom 'username' jika ada di tabel Anda
            // 'username' => 'admin', 

            // Password yang dienkripsi
            'password' => Hash::make('password123'), // Ganti 'password123' dengan password kuat Anda

            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            // Jika Anda memiliki kolom 'role' atau 'is_admin', tambahkan di sini:
            // 'role' => 'admin',
        ]);

        $this->command->info('Akun Admin telah berhasil dibuat: admin@timedoor.com (password123)');
    }
}
