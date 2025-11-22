<?php

return [

    'defaults' => [
        // Agora o guard padrão será o de FUNCIONÁRIO
        'guard' => 'funcionario',
        'passwords' => 'funcionarios',
    ],

    'guards' => [

        // Guard padrão Laravel (não usado para login)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard para Funcionários
        'funcionario' => [
            'driver' => 'session',
            'provider' => 'funcionarios',
        ],

        // Guard para Clientes
        'cliente' => [
            'driver' => 'session',
            'provider' => 'clientes',
        ],
    ],

    'providers' => [

        // Provider padrão Laravel (não usado)
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider de Funcionários
        'funcionarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Funcionario::class,
        ],

        // Provider de Clientes
        'clientes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Cliente::class,
        ],
    ],

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'funcionarios' => [
            'provider' => 'funcionarios',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'clientes' => [
            'provider' => 'clientes',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
