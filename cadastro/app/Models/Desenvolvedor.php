<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    use HasFactory;
    protected $table = "Desenvolvedores";

    function projeto(){
        //De muitos pra muitos
        //Um desenvolvedor pertence a muitos projetos
        return $this->belongsToMany(Projeto::class, 'locacoes')->withPivot('horas_semanais');
        
    }

}
