<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;

class ControladorHome extends Controller
{

    public function index(){
      
        if (Usuario::autenticado() == true) {
            //si el usuario tiene session iniciada entonces
            $titulo = "inicio";
            return view('sistema.index', compact('titulo'));
        } else {
            //Sino lo redirecciona al login
            return redirect('admin/login');
        }
        
    }

}
