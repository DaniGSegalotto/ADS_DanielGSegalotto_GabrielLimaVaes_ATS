<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use Illuminate\Support\Str;

class Funcionarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define o número de funcionários que deseja criar
        $funcionarios = 20;
        
        // Array contendo as opções de sexo
        $sexos = ['Masculino', 'Feminino'];

        // Arrays de nomes e sobrenomes brasileiros
        $nomes = [
            'João', 'Maria', 'Pedro', 'Ana', 'José', 'Paula', 'Carlos', 'Fernanda',
            'Paulo', 'Mariana', 'Lucas', 'Juliana', 'Rafael', 'Carla', 'Gabriel', 'Amanda'
        ];
        
        $sobrenomes = [
            'Silva', 'Souza', 'Oliveira', 'Santos', 'Pereira', 'Lima', 'Almeida', 'Ferreira',
            'Costa', 'Gomes', 'Ribeiro', 'Martins', 'Carvalho', 'Rocha', 'Dias', 'Nunes'
        ];

        // Inicializa um array para armazenar nomes completos usados
        $nomesCompletosUsados = [];

        // Loop para criar o número especificado de funcionários
        for ($i = 0; $i < $funcionarios; $i++) {
            // Seleciona um nome e sobrenome aleatórios que ainda não foram usados
            do {
                $nome = $nomes[array_rand($nomes)];
                $sobrenome = $sobrenomes[array_rand($sobrenomes)];
                $nomeCompleto = $nome . ' ' . $sobrenome;
            } while (in_array($nomeCompleto, $nomesCompletosUsados)); // Verifica se o nome completo já foi usado
            
            // Adiciona o nome completo usado ao array
            $nomesCompletosUsados[] = $nomeCompleto;

            // Seleciona um sexo aleatório do array $sexos
            $sexo = $sexos[array_rand($sexos)];
            // Gera um e-mail baseado no nome completo, convertendo para minúsculas e substituindo espaços por pontos
            $email = strtolower(Str::slug($nome . '.' . $sobrenome)) . '@gmail.com';

            // Cria um novo funcionário com os dados gerados
            Funcionario::create([
                'nome' => $nomeCompleto,
                'sexo' => $sexo,
                'email' => $email,
            ]);
        }
    }
}
