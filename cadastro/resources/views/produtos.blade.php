@extends('layout.app', ["current" => "produtos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
            @if (count($produtos) > 0)
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome da Produtos</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>
                                    <a href="/produtos/editar/{{$produto->id}}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="/produtos/apagar/{{$produto->id}}" class="btn btn-sm btn-danger">Del</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#produtoModal">
                Novo Produto
              </button>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="produtoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/produtos" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    @csrf
                        @if (count($categorias) > 0)

                            <label for="nomeProduto">Nome do Produto</label>
                            <input type="text" class="form-control" name="nomeProduto"
                            id="nomeProduto" placeholder="Produto">
                            

                            <label for="preco">Preço</label>
                            <input type="number" class="form-control" name="preco"
                            id="preco" placeholder="Preço">
                            

                            <label for="estoque">Estoque</label>
                            <input type="number" class="form-control" name="estoque"
                            id="estoque" placeholder="Estoque">
                            

                            <label for="nomeMarca">Nome da Marca</label>
                            
                            <select name="idMarca" class="form-control" aria-label="Nome da Marca">
                                <option selected value="0">Escolha uma Marca</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                            

                            
                        @else
                            <div class="alert alert-warning" role="alert">
                                Primeiro cadastre as categorias
                            </div>
                            <a class="btn btn-sm btn-primary" href="/categorias" role="button">Cadastrar Categoria</a>
                        @endif
                        
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
  </div>
</div>
    
@endsection

@section('javascript')
    <script>
        
    </script>
@endsection