<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Funcionario extends Model
{
   protected $table = 'funcionarios'; // Define o nome da tabela no banco de dados associada a este modelo
   protected $fillable = ['nome', 'email', 'sexo']; // Define os campos que podem ser atribuídos em massa
}
