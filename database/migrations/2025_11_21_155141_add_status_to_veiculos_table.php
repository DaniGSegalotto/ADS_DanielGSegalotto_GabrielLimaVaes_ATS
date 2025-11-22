<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona o campo status (boolean) na tabela veiculos.
     */
    public function up(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('marca_id');
        });
    }

    /**
     * Reverte a mudança removendo o campo status.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
