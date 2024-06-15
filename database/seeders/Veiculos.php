<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use App\Models\Marca;
use Illuminate\Support\Str;

class Veiculos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Defina o número de veículos que deseja criar
        $veiculos = 20;

        // Arrays de modelos, categorias e marcas fictícias para os veículos
        $veiculosData = [
            [
                'modelo' => 'Gol',
                'categoria' => 'Hatchback',
                'marcas' => ['Volkswagen'],
            ],
            [
                'modelo' => 'Uno',
                'categoria' => 'Hatchback',
                'marcas' => ['Fiat'],
            ],
            [
                'modelo' => 'Civic',
                'categoria' => 'Sedan',
                'marcas' => ['Honda'],
            ],
            [
                'modelo' => 'Corolla',
                'categoria' => 'Sedan',
                'marcas' => ['Toyota'],
            ],
            [
                'modelo' => 'Fiesta',
                'categoria' => 'Hatchback',
                'marcas' => ['Ford'],
            ],
            [
                'modelo' => 'Palio',
                'categoria' => 'Hatchback',
                'marcas' => ['Fiat'],
            ],
            [
                'modelo' => 'Onix',
                'categoria' => 'Hatchback',
                'marcas' => ['Chevrolet'],
            ],
            [
                'modelo' => 'HB20',
                'categoria' => 'Hatchback',
                'marcas' => ['Hyundai'],
            ],
            [
                'modelo' => 'Renegade',
                'categoria' => 'SUV',
                'marcas' => ['Jeep'],
            ],
            [
                'modelo' => 'Tucson',
                'categoria' => 'SUV',
                'marcas' => ['Hyundai'],
            ],
            [
                'modelo' => 'Compass',
                'categoria' => 'SUV',
                'marcas' => ['Jeep'],
            ],
            [
                'modelo' => 'Fusca',
                'categoria' => 'Clássico',
                'marcas' => ['Volkswagen'],
            ],
            [
                'modelo' => 'Kwid',
                'categoria' => 'Compacto',
                'marcas' => ['Renault'],
            ],
            [
                'modelo' => 'Logan',
                'categoria' => 'Sedan',
                'marcas' => ['Renault'],
            ],
            [
                'modelo' => 'Creta',
                'categoria' => 'SUV',
                'marcas' => ['Hyundai'],
            ],
            [
                'modelo' => 'Captur',
                'categoria' => 'SUV',
                'marcas' => ['Renault'],
            ]
        ];

        // Loop para criar o número especificado de veículos
        for ($i = 0; $i < $veiculos; $i++) {
            // Seleciona aleatoriamente um item dos dados de veículo
            $veiculoData = $veiculosData[array_rand($veiculosData)];

            // Seleciona aleatoriamente uma marca associada ao modelo do veículo
            $marca = Marca::where('descricao', $veiculoData['marcas'][array_rand($veiculoData['marcas'])])->first();

            // Gera uma placa fictícia de veículo
            $placa = chr(rand(65, 90)) . chr(rand(65, 90)) . '-' . rand(1000, 9999);

            // Gera um ano de fabricação fictício
            $ano = rand(2000, 2023);

            // Cria um novo veículo com os dados gerados
            Veiculo::create([
                'modelo' => $veiculoData['modelo'],
                'categoria' => $veiculoData['categoria'],
                'placa' => $placa,
                'ano' => $ano,
                'marca_id' => $marca->id, // Associa o veículo à marca selecionada
            ]);
        }
    }
}
