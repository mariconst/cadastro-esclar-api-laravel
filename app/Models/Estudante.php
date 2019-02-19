<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Estudante extends Model
{
    protected $fillable = [
        'nome', 'nascimento', 'serie', 'id_endereco', 'id_mae'
    ];
}
