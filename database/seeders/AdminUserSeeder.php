<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $username = env('ADMIN_USERNAME', 'arkan');
        $name = env('ADMIN_NAME', 'Administrator');
        $password = env('ADMIN_PASSWORD', 'password');

        if (!User::where('email', $email)->exists()) {
            User::create([
                'username' => $username,
                'nama_lengkap' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'level' => 'admin',
                'nik' => null,
                'nohp' => null,
            ]);
        }
    }
}
