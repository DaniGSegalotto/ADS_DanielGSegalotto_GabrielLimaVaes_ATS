<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nome da tabela associada ao modelo
    protected $table = 'clientes';

    // Campos que podem ser preenchidos automaticamente
    protected $fillable = [
        'nome',
        'telefone',
        'CPF',
        'CHN',       // ok manter se o campo existir no banco
        'email',
        'password',
    ];

    // Campos que devem ser ocultos em arrays e respostas JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
