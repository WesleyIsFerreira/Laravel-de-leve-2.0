<?php

use App\Http\Controllers\ControladorCategoria;
use App\Http\Controllers\ControladorProduto;
use App\Models\Cliente;
use App\Models\Desenvolvedor;
use App\Models\Endereco;
use App\Models\Projeto;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::prefix('categorias')->group(function () {
    Route::get('/', [ControladorCategoria::class, 'index'])->name('categorias');
    Route::get('/novo', [ControladorCategoria::class, 'create'])->name('categorias.create');
    Route::get('/apagar/{id}', [ControladorCategoria::class, 'destroy'])->name('categorias.destroy');
    Route::get('/editar/{id}', [ControladorCategoria::class, 'edit'])->name('categorias.edit');
    Route::post('/', [ControladorCategoria::class, 'store'])->name('categorias.store');
    Route::post('/editar/{id}', [ControladorCategoria::class, 'update'])->name('categorias.update');
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
Route::get('alocacao', function() {
    $dev = Desenvolvedor::find(4);
    if(isset($dev)){
        //$dev->projeto()->attach(1, ['horas_semanais' => 50]);

        $dev->projeto()->attach([
            2 => ['horas_semanais' => 20],
            3 => ['horas_semanais' => 30],
        ]);
    }


});

