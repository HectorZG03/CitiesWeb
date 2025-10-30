<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        //Usuarios de prueba para solo LOGIN xd

        // Usuario 1
        User::create([
            'name' => 'Usuario 1',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Usuario normal
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'usuario@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}