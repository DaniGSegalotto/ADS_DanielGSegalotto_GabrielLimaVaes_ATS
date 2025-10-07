<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Ativo', 'Indisponível', 'Vendido', 'Em manutenção'] as $nome) {
            Status::firstOrCreate(['descricao' => $nome]);
        }
    }
}
