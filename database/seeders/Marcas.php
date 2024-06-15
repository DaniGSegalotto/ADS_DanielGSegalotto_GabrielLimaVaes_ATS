<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;
use Illuminate\Support\Str;

class Marcas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define o número de marcas que deseja criar
        $marcas = 20;

        // Arrays de descrições e observações fictícias para as marcas
        $descricoes = [
            'Toyota', 'Volkswagen', 'Ford', 'Chevrolet', 'Honda', 'Nissan', 'BMW', 'Mercedes',
            'Audi', 'Hyundai', 'Kia', 'Peugeot', 'Renault', 'Fiat', 'Jeep', 'Subaru',
            'Mazda', 'Mitsubishi', 'Suzuki', 'Volvo'
        ];

        $observacoes = [
            'Confiável', 'Luxo', 'Econômico', 'Esportivo', 'Popular', 'Inovador', 'Durável', 
            'Seguro', 'Potente', 'Elegante', 'Compacto', 'Familiar', 'Off-road', 'Sofisticado',
            'Tecnológico', 'Clássico', 'Moderno', 'Sustentável', 'Resistente', 'Versátil'
        ];

        // Inicializa um array para armazenar descrições usadas
        $descricoesUsadas = [];

        // Loop para criar o número especificado de marcas
        for ($i = 0; $i < $marcas; $i++) {
            // Seleciona uma descrição aleatória que ainda não foi usada
            do {
                $descricao = $descricoes[array_rand($descricoes)];
            } while (in_array($descricao, $descricoesUsadas)); // Verifica se a descrição já foi usada
            
            // Adiciona a descrição usada ao array
            $descricoesUsadas[] = $descricao;

            // Seleciona uma observação aleatória dos arrays
            $observacao = $observacoes[array_rand($observacoes)];

            // Cria uma nova marca com os dados gerados
            Marca::create([
                'descricao' => $descricao,
                'observacao' => $observacao,
            ]);
        }
    }
}
