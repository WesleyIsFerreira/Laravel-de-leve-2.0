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

    public function getNomeAttribute($value)
    {
        //accessor --  o "nome" retornando a primeira letra maiuscula com ucfirst
        return ucfirst($value);
    }

    public function getNomeBatataAttribute($value)
    {
        //Outro accessor retornado "nome + id + batata"
        return "{$this->nome} {$this->id}" . ' Batata';
    }

    //Mutator, Quando setar o nome, será aplicado o codigoa abaixo
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtolower($value) . ' Verificado';
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'is_active' => 'boolean',

    ];

}
