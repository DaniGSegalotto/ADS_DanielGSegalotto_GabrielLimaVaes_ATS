<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Altera o CPF de bigint para string (varchar)
            $table->string('CPF', 14)->change();
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Reverte para bigint, caso necessário
            $table->bigInteger('CPF')->change();
        });
    }
};
