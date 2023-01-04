<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;
class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $cliente = new Cliente();
        $cliente->obtenerPorId(Session::get('idcliente'));

        $pedido = new Pedido();
        $aPedidos=$pedido->obtenerPorCliente(Session::get("idcliente"));
        
        return view("web.mi-cuenta", compact('aSucursales', 'cliente', 'aPedidos'));
    }
      
}
