<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sucursal;
use Session;

class ControladorCambiarClave extends Controller
{
    public function index()
    {
        $pg = "Cambiar clave";
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.recuperar-clave", compact('pg', 'aSucursales'));
    }
}