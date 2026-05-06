<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pedido::insert([
            'user_id' => '4',
            'endereco_id' => '1',
            'descricao' => 'descricao',
            'orcamento' => '999.99',
            'foto' => 'img.png',
            'emergencia' => '0',
            'disponibilidade' => 'Tarde',
            'data_preferida' => '2026-05-04',
            'status' => 'Pendente'
            ]);
    }
}
