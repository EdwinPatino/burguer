<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sucursal;
use Session;

class ControladorWebHome extends Controller
{
    public function index()
    {
        $pg = "inicio";
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.inicio", compact('pg', 'aSucursales'));
    }
}

