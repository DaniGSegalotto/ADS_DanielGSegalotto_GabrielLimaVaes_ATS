<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ Garantir que existam 2 status básicos
        DB::table('statuses')->updateOrInsert(
            ['id' => 1],
            ['descricao' => 'Disponível']
        );

        DB::table('statuses')->updateOrInsert(
            ['id' => 2],
            ['descricao' => 'Indisponível']
        );

        // 2️⃣ Atualiza todos os veículos para status_id válido
        DB::table('veiculos')
            ->whereNull('status_id')
            ->orWhereNotIn('status_id', [1, 2])
            ->update(['status_id' => 1]); // Disponível

        // 3️⃣ Remove todos os outros status que sobraram
        DB::table('statuses')
            ->whereNotIn('id', [1, 2])
            ->delete();
    }

    public function down(): void
    {
        // Restaura os antigos status se fizer rollback
        DB::table('statuses')->delete();

        DB::table('statuses')->insert([
            ['id' => 1, 'descricao' => 'Ativo'],
            ['id' => 2, 'descricao' => 'Inativo'],
            ['id' => 3, 'descricao' => 'Em manutenção'],
            ['id' => 4, 'descricao' => 'Disponível'],
            ['id' => 5, 'descricao' => 'Indisponível'],
        ]);
    }
};
