<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Authenticatable
{
    use Notifiable;

    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'email',
        'sexo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
