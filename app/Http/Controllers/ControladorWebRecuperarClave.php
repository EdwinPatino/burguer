<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        $pg = "recuperar-clave";

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.recuperar-clave", compact('pg', 'aSucursales'));
        
    }
}