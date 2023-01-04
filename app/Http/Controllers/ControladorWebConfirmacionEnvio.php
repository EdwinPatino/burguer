<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebConfirmacionEnvio extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.confirmacion-envio", compact('aSucursales'));
    }
}