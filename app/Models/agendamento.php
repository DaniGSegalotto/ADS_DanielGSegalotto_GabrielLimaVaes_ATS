<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $table = 'agendamentos';

    /**
     * Campos permitidos para criação/atualização
     */
    protected $fillable = [
        'cliente_id',
        'funcionario_id',
        'veiculo_id',
        'data',
        'horario'
    ];

    /**
     * Casts garantem que os tipos sempre venham corretos
     */
    protected $casts = [
        'data' => 'date',
        'horario' => 'string',
    ];

    /**
     * RELACIONAMENTOS
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
