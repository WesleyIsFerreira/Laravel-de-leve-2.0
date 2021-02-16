@extends('layout.app', ["current" => "categorias2"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            
                <table id="tabelaCategoria" class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nome da Categoria</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="loading">
                            <div class="d-flex align-items-center">
                                <td>
                                    <strong>Loading...</strong>
                                </td>
                                <td>
                                    <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                                </td>
                            </div>
                        </tr>
                    </tbody>
                </table>
            

        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-6">
                    <a href="/categorias/novo" class="btn btn-sm btn-primary" role="bitton">Nova Categoria</a>
                </div>
                <div class="col-6 float-right">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id="paginacao">
                            <!-- 
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        -->
                        </ul>
                      </nav>
                </div>
              </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>

        $(function(){
            carregarcategorias(1)
        });
        
        function carregarcategorias(pagina){
            $.get('/categorias/json', {page: pagina}, function(resp){

                $('#tabelaCategoria>tbody>tr').remove();
                $('#paginacao>li').remove();
            
                console.log(resp);
                linha = '';
                for(i = 0; i < resp.data.length; i++){
                    //console.log(resp.data[i].id);
                    linha += '<tr>'+
                                '<td>'+resp.data[i].id +'</td>'+
                                '<td>'+resp.data[i].nome +'</td>'+
                                '<td>'+
                                    '<a href="/categorias/editar/'+resp.data[i].id +'" class="btn btn-sm btn-primary">Edit</a>'+
                                    '<a href="/categorias/apagar/'+resp.data[i].id +'" class="btn btn-sm btn-danger">Del</a>'+
                                '</td>'+
                            '</tr>';
                }
                //console.log(linha);
                $('#tabelaCategoria>tbody').append(linha);
    
                paginacao = montarPaginacao(resp);
    
                $('#paginacao').append(paginacao);

                $('#paginacao>li>a').click(function(){
                    //console.log($(this).text());
                    console.log( $(this).attr('pagina') );
                    if($(this).text() == 'Anterior'){
                        pagina = resp.current_page - 1;
                    }else if($(this).text() == 'Próximo'){
                        pagina = resp.current_page + 1;
                    }else if(  $(this).attr('pagina') == undefined){
                        console.log($(this).attr('pagina'))
                        pagina = $(this).text();
                    }else{
                        pagina = $(this).attr('pagina');
                    }

                    carregarcategorias(pagina);
                });
    
                $('#loading').remove();
    
            });
        }
        

        function montarPaginacao(resp){

            paginacao = '';

            if(resp.current_page == 1){
                paginacao = '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)">Anterior</a></li>';
            }else{
                paginacao = '<li class="page-item"><a class="page-link" href="javascript:void(0)">Anterior</a></li>';
            }

            if(resp.current_page > 2){
                
                paginacao += '<li class="page-item">' +
                                '<a pagina="1" class="page-link" href="javascript:void(0)" aria-label="Previous">'+
                                '<span aria-hidden="true">&laquo;</span>'+
                                '</a>'+
                             '</li>';
            }

            if(resp.current_page > 1 && resp.current_page < resp.last_page){
                paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.current_page - 1) +'</a></li>';
                paginacao +='<li class="page-item active"><a class="page-link" href="javascript:void(0)">'+ resp.current_page +'</a></li>';
                paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.current_page + 1) +'</a></li>';
            }else if(resp.current_page == 1){
                paginacao +='<li class="page-item active"><a class="page-link" href="javascript:void(0)">'+ resp.current_page +'</a></li>';

                if(resp.last_page !=1){
                    paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.current_page + 1) +'</a></li>';
                    if(resp.last_page !=2)
                        paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.current_page + 2) +'</a></li>';
                }
            }else{
                if((resp.last_page - 2) != 0)
                paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.last_page - 2) +'</a></li>';
                paginacao +='<li class="page-item"><a class="page-link" href="javascript:void(0)">'+ (resp.last_page - 1) +'</a></li>';
                paginacao +='<li class="page-item active"><a class="page-link" href="javascript:void(0)">'+ resp.last_page +'</a></li>';
            }

            if((resp.current_page + 1) < resp.last_page){
                
                paginacao += '<li class="page-item">' +
                                '<a pagina="'+resp.last_page+'" class="page-link" href="javascript:void(0)" aria-label="Next">'+
                                '<span aria-hidden="true">&raquo;</span>'+
                                '</a>'+
                             '</li>';
            }

            if(resp.last_page == resp.current_page){
                paginacao += '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)">Próximo</a></li>';
            }else{
                paginacao += '<li class="page-item"><a class="page-link" href="javascript:void(0)">Próximo</a></li>';
            }
            
            return paginacao;
        }
        
    </script>
@endsection