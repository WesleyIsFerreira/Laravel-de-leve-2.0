<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorUsuario extends Controller
{

    public function index(){
        return view('usuario.inicio');
    }

    public function login(Request $req){
        
        $login_ok = false;

        //dd($req->input('inputPassword'));

        if ($req->input('login')=="wesley" && $req->input('inputPassword')=="123"){
            $login = ['user' => $req->input('login')];
            $req->session()->put('login',$login);
            $login_ok = true;
            return redirect('/');
        }else{
            $req->session()->flush();
            return response("Tudo ERRADO", 200);
        }
    }
}
