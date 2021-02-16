<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function scopeInsere($query, $email, $mensagem,$arquivo)
    {
        $query = new Post();
        $query->email = $email;
        $query->mensagem = $mensagem;
        $query->arquivo = $arquivo;
        return $query;
    }
}
