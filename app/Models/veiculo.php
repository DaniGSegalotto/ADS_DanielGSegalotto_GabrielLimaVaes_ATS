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
        'status_id'
    ];

    // Marca do veículo
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Status do veículo (Disponível, Indisponível, etc.)
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * Scope que retorna somente veículos disponíveis.
     * Facilita o uso no sistema inteiro.
     */
    public function scopeDisponiveis($query)
    {
        return $query->where('status_id', 1); // 1 = Disponível
    }
}
