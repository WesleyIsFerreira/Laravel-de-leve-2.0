<?php

use App\Http\Controllers\ControladorCategoria;
use App\Http\Controllers\ControladorProduto;
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

});