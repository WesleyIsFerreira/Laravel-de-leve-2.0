@extends('layout.app', ["current" => "produtos"])
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="POST">
                <div class="form-group">
                    @csrf
                        @if (count($categorias) > 0)

                            <label for="nomeProduto">Nome do Produto</label>
                            <input type="text" class="form-control" name="nomeProduto"
                            id="nomeProduto" placeholder="Produto">
                            <br>

                            <label for="preco">Preço</label>
                            <input type="number" class="form-control" name="preco"
                            id="preco" placeholder="Preço">
                            <br>

                            <label for="estoque">Estoque</label>
                            <input type="number" class="form-control" name="estoque"
                            id="estoque" placeholder="Estoque">
                            <br>

                            <label for="nomeMarca">Nome da Marca</label>
                            <br>
                            <select name="idMarca" class="form-control" aria-label="Nome da Marca">
                                <option selected value="0">Escolha uma Marca</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                            <br>

                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Primeiro cadastre as categorias
                            </div>
                            <a class="btn btn-sm btn-primary" href="/categorias" role="button">Cadastrar Categoria</a>
                        @endif
                    <br><br>        
                </div>
            </form>
        </div>
    </div>
@endsection