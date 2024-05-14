<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Usa as traits necessárias

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nome do usuário
        'email', // Endereço de e-mail do usuário
        'password', // Senha do usuário
    ];

    /**
     * Os atributos que devem ser ocultos para serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Senha do usuário
        'remember_token', // Token de lembrança do usuário
    ];

    /**
     * Os atributos que devem ser convertidos para tipos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte para o tipo datetime
        'password' => 'hashed', // Indica que a senha deve ser armazenada como uma hash
    ];
}
