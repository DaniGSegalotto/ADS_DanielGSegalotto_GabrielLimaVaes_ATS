<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->string('imagem')->nullable()->after('status_id');
    });
}

public function down()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->dropColumn('imagem');
    });
}

};
