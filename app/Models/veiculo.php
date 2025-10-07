<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculos';

    protected $fillable = [
        'modelo',
        'categoria',
        'placa',
        'ano',
        'marca_id',
        'status_id', // <- campo correto
    ];

    // Removido o cast antigo de 'status' (não é mais boolean)
    protected $casts = [];

    // Relacionamento com Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relacionamento com Status (FK = status_id)
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
