<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        // Evita duplicações ao rodar novamente
        $statuses = [
            'Ativo',
            'Inativo',
            'Em manutenção',

        
            'Disponível',
            'Indisponível',
        ];

        foreach ($statuses as $descricao) {
            Status::firstOrCreate(['descricao' => $descricao]);
        }
    }
}
