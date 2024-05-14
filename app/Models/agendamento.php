<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
   protected $table = 'agendamentos'; // Define o nome da tabela no banco de dados associada a este modelo
   protected $fillable = ['data', 'horario', 'funcionario_id', 'veiculo_id', 'cliente_id']; // Define os campos que podem ser atribuídos em massa

   public function funcionario() {
    return $this->belongsTo(Funcionario::class);
 }
 public function veiculo() {
    return $this->belongsTo(Veiculo::class);
 }
 public function cliente() {
    return $this->belongsTo(Cliente::class);
 }
}
