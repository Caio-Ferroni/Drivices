<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::insert([
        //     'name' => 'caio',
        //     'email' => 'caio@gmail.com',
        //     'password' => bcrypt('senha'),
        //     'cpf' => '12345678910',
        //     'nascimento' => date('Y-m-d'),
        //     'tipo' => 'Administrador',
        // ]);
        User::insert([
            'name' => 'gdkicaj',
            'email' => 'gdkicaj@gmail.com',
            'password' => bcrypt('senha'),
            'cpf' => '12345678910',
            'nascimento' => date('Y-m-d'),
            'tipo' => 'Admin',
        ]);
    }
}
