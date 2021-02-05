<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    function categoria(){
        //Um pra muitos
        //Um produto pertence uma categoria
        return $this->belongsTo(Categorias::class);
    }
}
