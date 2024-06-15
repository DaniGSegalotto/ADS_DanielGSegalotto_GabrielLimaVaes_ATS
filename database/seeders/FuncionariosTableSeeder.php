<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionariosTableSeeder extends Seeder
{

    public function run(): void
    {
        $funcionarios = 5;

        for ($i = 0; $i < $funcionarios; $i++){
        Funcionario::create([
            'nome' => $this->getNomeAleatorio(),
            'email' => $this->getEmailAleatorio().'@UPF.BR',
            'sexo' => $this->getSexoAleatorio(),
        ]);
    }
}


 /*
 * @return string
 */

private function getSexoAleatorio(): string
{
    $sexos = ['Masculino', 'Feminino', 'Outros'];
    $index = random_int(0, count($sexos) - 1); // Escolhe um índice aleatório do array
    return $sexos[$index];
}

private function getEmailAleatorio(): string
{
    $emails = ['199663', '133657', '199087', '199067', '189076', '123999', '998677'];
    $index = random_int(0, count($emails) - 1); // Escolhe um índice aleatório do array
    return $emails[$index];
}

private function getNomeAleatorio(): string
{
    $nomes = ['Daniel', 'Gabriel', 'Nicolas', 'Ricardo', 'Luis', 'Henrique', 'Diogo'];
    $index = random_int(0, count($nomes) - 1); // Escolhe um índice aleatório do array
    return $nomes[$index];
}
}