<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fatura extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cao_fatura';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'co_cliente', 'co_cliente');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'co_sistema', 'co_sistema');
    }
}
