<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    // Define o nome da tabela no banco de dados associada a este modelo
    protected $table = 'agendamentos';

    // Define os campos que podem ser atribuídos em massa
    protected $fillable = ['data', 'horario', 'funcionario_id', 'veiculo_id', 'cliente_id'];

    // Define a relação "pertence a" com o modelo Funcionario
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    // Define a relação "pertence a" com o modelo Veiculo
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    // Define a relação "pertence a" com o modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
