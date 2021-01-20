@extends('layout.app', ["current" => "categorias"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form action="/categorias/editar/{{$cat->id}}" method="POST">
                <div class="form-group">
                    @csrf
                    <label for="nomeCategoria">Nome da Categoria</label>
                    <input type="text" class="form-control" name="nomeCategoria"
                    id="nomeCategoria" placeholder="Categorias" value="{{$cat->nome}}">
                    <br>
                    <button type="submit" class="btn btn-primary btn-sm">Salvar Edição</button>
                    <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

@endsection