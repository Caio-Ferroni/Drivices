<?php

namespace Database\Seeders;

use App\Models\Oferta;
use Illuminate\Database\Seeder;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Oferta::insert([
            'pedido_id' => '1',
            'professional_id' => '1',
            'custo' => '800.99',
            
        ]);
    }
}
