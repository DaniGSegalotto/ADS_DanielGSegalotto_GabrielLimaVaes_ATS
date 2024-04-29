<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->time('horario');
            $table->date('data');
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

            $table-> foreign('funcionario_id')->references('id')->on('funcionarios');
            $table-> foreign('veiculo_id')->references('id')->on('veiculos');
            $table-> foreign('cliente_id')->references('id')->on('clientes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
