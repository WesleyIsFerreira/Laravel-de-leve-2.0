<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    function produto(){
        //return $this->hasMany(Produtos::class);
        return $this->hasMany(Produtos::class, 'categoria_id', 'id');
    }
}
