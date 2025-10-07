<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['descricao'];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'status', 'id'); // FK em 'veiculos.status'
    }
}
