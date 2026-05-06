<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Endereco::insert([
            'user_id' => '4',
            'cep' => '12345999',
            'logradouro' => 'Rua Legal',
            'complemento' => 'Ali do lado',
            'unidade' => '7',
            'bairro' => 'bairro',
            'localidade' => 'São Paulo',
            'uf' => 'SP',
            'regiao' => 'Norte',
        ]);
    }
}
