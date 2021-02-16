<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControladorPost extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('fotos', compact('posts'));
    }

    public function store(Request $request)
    {
        
        $email = $request->input('email');
        $mensagem = $request->input('mensagem');
        $arquivo = $request->file('arquivo')->store('imgPosts','public');

        //testando scope local
        $post = Post::insere($email, $mensagem, $arquivo);
        $post->save();
        return redirect('fotos');
    }

    public function baixar($id)
    {
        $post = Post::find($id);
        if(isset($post)){
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($post->arquivo);
            return response()->download($path);
        }
        return redirect('fotos');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if(isset($post)){
            $path = $post->arquivo;
            Storage::disk('public')->delete($path);
            $post->delete();
        }
        return redirect('fotos');
    }
}
