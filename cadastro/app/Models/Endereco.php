<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    
    use HasFactory;

    function cliente(){
        //Um pra um
        //Um cliente tem apenas um endereço vinculado
        //Cliente funciona como tabela principal
        return $this->belongsTo(Cliente::class);
    }

}
