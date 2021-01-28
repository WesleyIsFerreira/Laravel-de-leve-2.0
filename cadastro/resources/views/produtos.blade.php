@extends('layout.app', ["current" => "produtos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
            @if (count($produtos) > 0)
                <table id="tabelaProduto" class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome</td>
                            <td>Quantidade</td>
                            <td>Preço</td>
                            <td>Departamento</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->estoque}}</td>
                                <td>{{$produto->preco}}</td>
                                <td>{{$produto->categoria_id}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editar( {{$produto->id}} )" >Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="apagar( {{$produto->id}} )" >Apagar</button>
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
    <form action="/produtos" method="POST" id="formProduto">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
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
                            
                            <select id="idMarca" name="idMarca" class="form-control" aria-label="Nome da Marca">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" onclick="salvarProduto()" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
  </div>
</div>
    
@endsection

@section('javascript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function salvarProduto(){
            prod = {
                preco: $("#preco").val(),
                nome: $("#nomeProduto").val(),
                estoque: $("#estoque").val(),
                idMarca: $("#idMarca").val()
            };
            
            $.post("/produtos", prod, function(data) {
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $("#tabelaProduto>tbody").append(linha);
            });

            $("#produtoModal").modal('hide')
        }

        function montarLinha(p){

            let linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.nome + "</td>" +
                "<td>" + p.estoque + "</td>" +
                "<td>" + p.preco + "</td>" +
                "<td>" + p.categoria + "</td>" +
                "<td>"+
                    '<button class="btn btn-sm btn-primary" onclick="editar('+  p.id +')" >Edit</button>' +
                    '<button class="btn btn-sm btn-danger" onclick="apagar('+  p.id +')" >Apagar</button>' +
                "</td>"+
                "</tr>";

                return linha;
        }

        function apagar(id){
            $.ajax({
                type: "HEAD",
                url: "/produtos/apagar/" + id,
                context: this,
                success: function(){
                    console.log("Apagou a parada");
                },
                error: function(){
                    console.log("Deu pau");
                }
            });
        }

        function editar(id){
            linhas = $("#tabelaProduto>tbody>tr");
            e = linhas.filter( function(i,e){
                return (e.cells[0].textContent == id)
            })
            console.log(e);
        }

    </script>
@endsection