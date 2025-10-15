<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        // Evita duplicações se rodar mais de uma vez
        if (Status::count() === 0) {
            Status::insert([
                ['descricao' => 'Ativo'],
                ['descricao' => 'Inativo'],
                ['descricao' => 'Em manutenção'],
            ]);
        }
    }
}
