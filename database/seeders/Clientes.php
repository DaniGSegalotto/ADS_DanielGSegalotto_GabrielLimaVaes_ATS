<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Illuminate\Support\Str;

class Clientes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Defina o número de clientes que deseja criar
        $clientes = 20;

        // Arrays de nomes e sobrenomes brasileiros
        $nomes = [
            'Luiz', 'Bruna', 'Fábio', 'Isabela', 'Gustavo', 'Larissa', 'Renato', 'Camila',
            'Felipe', 'Bianca', 'Rodrigo', 'Tatiana', 'Diego', 'Cláudia', 'Thiago', 'Vanessa'
        ];

        $sobrenomes = [
            'Mendes', 'Ramos', 'Teixeira', 'Barbosa', 'Pinto', 'Araújo', 'Miranda', 'Reis',
            'Dias', 'Cardoso', 'Campos', 'Santiago', 'Moura', 'Peixoto', 'Faria', 'Castro'
        ];

        // Array para prefixos de telefone permitidos
        $prefixosTelefone = ['54996', '54999', '54991'];

        // Inicializa um array para armazenar nomes completos usados
        $nomesCompletosUsados = [];

        // Loop para criar o número especificado de clientes
        for ($i = 0; $i < $clientes; $i++) {
            // Seleciona um nome e sobrenome aleatórios que ainda não foram usados
            do {
                $nome = $nomes[array_rand($nomes)];
                $sobrenome = $sobrenomes[array_rand($sobrenomes)];
                $nomeCompleto = $nome . ' ' . $sobrenome;
            } while (in_array($nomeCompleto, $nomesCompletosUsados)); // Verifica se o nome completo já foi usado
            
            // Adiciona o nome completo usado ao array
            $nomesCompletosUsados[] = $nomeCompleto;

            // Seleciona um prefixo de telefone aleatório
            $prefixo = $prefixosTelefone[array_rand($prefixosTelefone)];
            // Gera os últimos 6 dígitos do número de telefone
            $telefone = $prefixo . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Gera números aleatórios para CPF e CHN
            $cpf = rand(10000000000, 99999999999); // Gera um número aleatório de 11 dígitos
            $chn = rand(10000000000, 99999999999); // Gera um número aleatório de 11 dígitos

            // Gera um e-mail baseado no nome completo, convertendo para minúsculas e substituindo espaços por pontos
            $email = strtolower(Str::slug($nome . '.' . $sobrenome)) . '@gmail.com';

            // Cria um novo cliente com os dados gerados
            Cliente::create([
                'nome' => $nomeCompleto,
                'telefone' => $telefone,
                'CPF' => $cpf,
                'CHN' => $chn,
                'email' => $email,
            ]);
        }
    }
}
