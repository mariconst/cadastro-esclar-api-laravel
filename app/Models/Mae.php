<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mae extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'dia_pagamento'
    ];
}
