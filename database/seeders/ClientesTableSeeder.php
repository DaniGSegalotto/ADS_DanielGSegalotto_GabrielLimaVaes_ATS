<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{

    public function run(): void
    {
        $clientes = 20;

        for ($i = 0; $i < $users; $i++){
        Cliente::create([
            'name' => Str::random(10),
            'telefone' => Int::random(11),
            'CPF' => Int::random(11),
            'CHN' => Int::random(9),
            'email' => Str::random(10),
            'password' => bcrypt('password'),
        ]);
    }
    }
}   
