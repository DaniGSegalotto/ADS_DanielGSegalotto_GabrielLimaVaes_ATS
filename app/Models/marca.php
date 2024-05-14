<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
   protected $table = 'marcas'; // Define o nome da tabela no banco de dados associada a este modelo
   protected $fillable = ['descricao', 'observacao']; // Define os campos que podem ser atribuídos em massa
}
