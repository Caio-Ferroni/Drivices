<?php

namespace Database\Seeders;

use App\Models\Professional;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Professional::insert([
        'user_id' => '1',
        'biografia' => 'biografia profissional',
        'nota' => '5.0',
        'stripe' => '1',
       ]);
    }
}
