<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;

    function endereco(){
        //Um pra um
        //Um endereço pertence a um cliente
        return $this->hasOne(Endereco::class);
    }

}
