<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;


class ControladorCategoria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('primeiro');
        $this->middleware('login');
    }

    public function index()
    {
        $categorias = Categorias::with(['produto']);
        $categorias = $categorias->paginate(10);
        return view('categoria.categorias', compact('categorias'));
    }

    public function index2()
    {
        return view('categoria.categorias2');
    }

    public function categoriajson(){
        $categorias = Categorias::with(['produto']);
        return $categorias->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.novaCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new Categorias();
        $cat->nome = $request->input('nomeCategoria');
        $cat->save();
        return redirect('/categorias/2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Categorias::find($id);
        if (isset($cat)){
            return view('categoria.editarCategoria', compact('cat'));
        }
        return redirect('/categorias/2');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = Categorias::find($id);
        if (isset($cat)){
            $cat->nome = $request->input('nomeCategoria');
            $cat->save();
        }
        return redirect('/categorias/2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categorias::find($id);
        if (isset($cat)){
            $cat->delete();
        }else{
            throw 'Moio';
        }
        return redirect('/categorias/2');
    }

    public function indexJSON(){
        $categorias = Categorias::all();
        return json_decode($categorias);
    }

    public function factory($qtd){
         Categorias::factory($qtd)->create();
         return redirect('/categorias/2');
    }
}
