<?php

use App\Http\Controllers\ControladorCategoria;
use App\Http\Controllers\ControladorProduto;
use App\Http\Controllers\controladorUsuario;
use App\Http\Controllers\ControladorPost;
use App\Http\Middleware\PrimeiroMiddleware;
use App\Models\Cliente;
use App\Models\Desenvolvedor;
use App\Models\Endereco;
use App\Models\Projeto;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home')->middleware('login');

Route::prefix('usuarios')->group(function (){
    //antes de cadastrar Middleware no kernel
    //Route::get('/', [controladorUsuario::class, 'index'])->name('index')->middleware(PrimeiroMiddleware::class);
    
    //depois de cadastrar Middleware no kernel
    Route::get('/', [controladorUsuario::class, 'index'])->name('index')->middleware('primeiro');

    //colocando Middlewareno controller
    Route::post('/', [controladorUsuario::class, 'login'])->name('login');


});

Route::prefix('categorias')->group(function () {
    Route::get('/', [ControladorCategoria::class, 'index'])->name('categorias');
    Route::get('/2', [ControladorCategoria::class, 'index2'])->name('categorias2');
    Route::get('/novo', [ControladorCategoria::class, 'create'])->name('categorias.create');
    Route::get('/apagar/{id}', [ControladorCategoria::class, 'destroy'])->name('categorias.destroy');
    Route::get('/editar/{id}', [ControladorCategoria::class, 'edit'])->name('categorias.edit');
    Route::post('/', [ControladorCategoria::class, 'store'])->name('categorias.store');
    Route::post('/editar/{id}', [ControladorCategoria::class, 'update'])->name('categorias.update');
    Route::get('/json', [ControladorCategoria::class, 'categoriajson'])->name('categorias.categoriajson');

});

Route::prefix('produtos')->group(function () {
    Route::get('/', [ControladorProduto::class, 'index'])->name('produtos');
    Route::get('/novo', [ControladorProduto::class, 'create'])->name('produtos.create');
    Route::get('/apagar/{id}', [ControladorProduto::class, 'destroy'])->name('produtos.destroy');
    Route::get('/editar/{id}', [ControladorProduto::class, 'edit'])->name('produtos.edit');
    Route::post('/', [ControladorProduto::class, 'store'])->name('produtos.store');
    Route::post('/editar/{id}', [ControladorProduto::class, 'update'])->name('produtos.update');
    Route::get('/{id}', [ControladorProduto::class, 'show'])->name('produtos.show');
});


Route::get('/clientes', function() {
    $clientes = Cliente::all();
    foreach($clientes as $c){

        echo "<p>Id: ". $c->id ."</p>";
        echo "<p>Nome: ". $c->nome ."</p>";
        echo "<p>Telefone: ". $c->telefone ."</p>";

        echo "<p>Rua: ". $c->endereco->rua ."</p>";
        echo "<p>Numero: ". $c->endereco->numero ."</p>";
        echo "<p>Bairro: ". $c->endereco->bairro ."</p>";
        echo "<p>Cidade: ". $c->endereco->cidade ."</p>";
        echo "<p>Uf: ". $c->endereco->uf ."</p>";
        echo "<p>CEP: ". $c->endereco->cep ."</p>";
        echo "<hr>";

    }

});

Route::get('/fotos', [ControladorPost::class, 'index'])->name('fotos');
Route::post('/fotos', [ControladorPost::class, 'store'])->name('fotos.store');
Route::get('/fotos/{id}', [ControladorPost::class, 'destroy'])->name('fotos.store');
Route::get('/fotos/baixar/{id}', [ControladorPost::class, 'baixar'])->name('fotos.baixar');


Route::get('/desenvolvedor', function() {
    $desenvolvedor = Desenvolvedor::with(['projeto'])->get();
    return $desenvolvedor->toJson();
});

Route::get('/projeto', function() {
    $projetos = Projeto::with(['desenvolvedor'])->get();
    return $projetos->toJson();
});


Route::get('/clientes/json', function() {
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});

Route::get('/endereco/json', function() {
    $endereco = Endereco::with(['cliente'])->get();
    return $endereco->toJson();
});

//Rota pra inseriri uns registros para teste
Route::get('/inserir', function() {
    
    $c = new Cliente();
    $c->nome = "Marcos Becasse";
    $c->telefone = "32514552";
    $c->save();

    $e = new Endereco();
    $e->rua ="Maurilio Biafgi";
    $e->numero = 12;
    $e->bairro = "Zona Norte";
    $e->cidade = "Ibate";
    $e->uf ="SP";
    $e->cep = "14840000";

    $c->endereco()->save($e);

    $c = new Cliente();
    $c->nome = "Julia da costa";
    $c->telefone = "32514455";
    $c->save();

    $e = new Endereco();
    $e->rua ="Marafão 2";
    $e->numero = 123;
    $e->bairro = "Zona Sul";
    $e->cidade = "Ibate";
    $e->uf ="SP";
    $e->cep = "14840000";
    $c->endereco()->save($e);

});

//Inserido em Tabela de M pra N
Route::get('/alocacao', function() {
    $dev = Desenvolvedor::find(4);
    if(isset($dev)){
        //$dev->projeto()->attach(6, ['horas_semanais' => 50]);
        $dev->projeto()->attach([
            7 => ['horas_semanais' => 20],
            8 => ['horas_semanais' => 30],
        ]);
    }
});

//Desalocando registros de M pra N

Route::get('/desalocacao', function() {
    $dev = Desenvolvedor::find(4);
    if(isset($dev)){
        $dev->projeto()->detach([7,8]);
    }
});

Route::get('/logout', function(Request $req) {
    $req->session()->flush();
    return redirect('/usuarios');
});
