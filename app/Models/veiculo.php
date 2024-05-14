<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
   protected $table = 'veiculos'; // Define o nome da tabela no banco de dados associada a este modelo
   protected $fillable = ['modelo', 'categoria', 'placa', 'ano', 'marca_id']; // Define os campos que podem ser atribuídos em massa

   // Define o relacionamento "pertence a" com o modelo Marca
   public function marca() {
      return $this->belongsTo(Marca::class);
   }
}

