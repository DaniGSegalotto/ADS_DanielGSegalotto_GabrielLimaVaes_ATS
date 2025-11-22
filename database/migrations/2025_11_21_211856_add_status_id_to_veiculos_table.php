<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // adiciona a coluna se não existir
            if (!Schema::hasColumn('veiculos', 'status_id')) {
                $table->unsignedBigInteger('status_id')->default(1); // 1 = Disponível
                $table->foreign('status_id')->references('id')->on('statuses');
            }
        });
    }

    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            if (Schema::hasColumn('veiculos', 'status_id')) {
                $table->dropForeign(['status_id']);
                $table->dropColumn('status_id');
            }
        });
    }
};
