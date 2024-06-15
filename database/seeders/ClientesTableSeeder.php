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
        $clientes = 5;

        for ($i = 0; $i < $clientes; $i++){
        Cliente::create([
            'nome' => $this->getNomeAleatorio(),
            'telefone' => '996' . rand(100000, 999999), // Gera um número aleatório com 6 dígitos após '996'
            'CPF' => rand(10000000000, 99999999999), 
            'CHN' => rand(100000000, 999999999),
            'email' => $this->getEmailAleatorio().'@UPF.BR',
        ]);
    }
    }

 /*
 * @return string
 */

private function getNomeAleatorio(): string
{
    $nomes = ['Daniel', 'Gabriel', 'Nicolas', 'Ricardo', 'Luis', 'Henrique', 'Diogo'];
    $index = random_int(0, count($nomes) - 1); // Escolhe um índice aleatório do array
    return $nomes[$index];
}

private function getEmailAleatorio(): string
{
    $emails = ['199663', '133657', '199087', '199067', '189076', '123999', '998677'];
    $index = random_int(0, count($emails) - 1); // Escolhe um índice aleatório do array
    return $emails[$index];
}

}   


