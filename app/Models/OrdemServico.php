<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cao_os';

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'co_sistema', 'co_usuario');
    }
}
