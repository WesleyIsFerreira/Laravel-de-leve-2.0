<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    function produto(){
        //Um pra muitos
        //Uma categoria pertence a varios produtos
        return $this->hasMany(Produtos::class, 'categoria_id', 'id');
    }
}
