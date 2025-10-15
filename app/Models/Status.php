<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['descricao'];
    public $timestamps = false; // adiciona se a tabela não tiver created_at/updated_at

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'status_id', 'id');
    }
}
