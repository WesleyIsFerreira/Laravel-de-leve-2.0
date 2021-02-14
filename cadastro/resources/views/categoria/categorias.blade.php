@extends('layout.app', ["current" => "categorias"])

@section('body')

    <div>
        <p>
            100% blade, até mesmo os bugs do designe no "$categorias->links()"
        </p>
        <p>
            Problemas resolvidos na pag Categorias2
        </p>
    </div>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            @if (count($categorias) > 0)
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome da Categoria</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nome}}</td>
                                <td>
                                    <a href="/categorias/editar/{{$categoria->id}}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="/categorias/apagar/{{$categoria->id}}" class="btn btn-sm btn-danger">Del</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="/categorias/novo" class="btn btn-sm btn-primary" role="bitton">Nova Categoria</a>
                </div>
                <div class="col-2">
                  {{ $categorias->links() }}
                </div>
              </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        @foreach  ($categorias as $categoria)
        <div class="col-sm">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">{{$categoria->nome}}</li>
                @foreach ($categoria->produto as $produto)
                    <li class="list-group-item">{{$produto->nome}}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>

@endsection