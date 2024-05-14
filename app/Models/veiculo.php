<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class veiculo extends Model
{
   protected $table = 'veiculos';
   protected $fillable = ['modelo', 'categoria', 'placa', 'ano', 'marca_id'];

   public function marca() {
      return $this->belongsTo(Marca::class);
   }
   
}


