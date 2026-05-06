<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'caio',
                'email' => 'caio@gmail.com',
                'password' => bcrypt('senha'),
                'cpf' => '12345678910',
                'nascimento' => date('Y-m-d'),
                'tipo' => 'Usuario',
            ],
            [
                'name' => 'aetern',
                'email' => 'aetern@gmail.com',
                'password' => bcrypt('senha'),
                'cpf' => '12345678990',
                'nascimento' => date('Y-m-d'),
                'tipo' => 'Admin',
            ],

            [
                'name' => 'gdkicaj',
                'email' => 'gdkicaj@gmail.com',
                'password' => bcrypt('senha'),
                'cpf' => '11122233344',
                'nascimento' => date('Y-m-d'),
                'tipo' => 'Admin',
            ],

            [
                'name' => 'kyer',
                'email' => 'kyer@gmail.com',
                'password' => bcrypt('senha'),
                'cpf' => '12312312399',
                'nascimento' => date('Y-m-d'),
                'tipo' => 'Usuario',
            ],
            [
                'name' => 'pwio',
                'email' => 'pwio@gmail.com',
                'password' => bcrypt('senha'),
                'cpf' => '12345678900',
                'nascimento' => date('Y-m-d'),
                'tipo' => 'Usuario',
            ],

        ]);

    }
}
