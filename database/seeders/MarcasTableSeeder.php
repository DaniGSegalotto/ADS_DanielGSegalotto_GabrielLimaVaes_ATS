<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasTableSeeder extends Seeder
{

    public function run(): void
    {
        $marcas = 5;

        for ($i = 0; $i < $marcas; $i++){
        Marca::create([
            'descricao' => $this->getdescAleatorio(),
            'observacao' => $this->getObsAleatorio(),
        ]);
    }
}


 /*
 * @return string
 */

private function getdescAleatorio(): string
{
    $desc = ['Econômico', 'Turbo', 'Old', 'Passeio', 'Corrida'];
    $index = random_int(0, count($desc) - 1); 
    return $desc[$index];
}

private function getObsAleatorio(): string
{
    $obs = ['Fipe alta', '100% Conservado', 'Lata OK', 'Penus bons', 'Motor OK'];
    $index = random_int(0, count($obs) - 1);
    return $obs[$index];
}

}

