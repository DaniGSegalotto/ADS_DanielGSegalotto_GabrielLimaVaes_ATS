<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
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
