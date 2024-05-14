<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $table = 'clientes'; // Define o nome da tabela no banco de dados associada a este modelo
   protected $fillable = ['nome', 'telefone', 'CPF', 'CHN', 'email']; // Define os campos que podem ser atribuídos em massa
}
