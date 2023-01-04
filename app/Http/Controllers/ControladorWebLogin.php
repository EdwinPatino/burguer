<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use App\Entidades\Cliente;
use Session;
class ControladorWebLogin extends Controller
{
    public function index()
    {
        $pg = "login";

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.login", compact('pg', 'aSucursales'));
    }

    public function ingresar(Request $request){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $pg = "login";
        $correo = $request->input('txtCorreo');
        $clave = $request->input('txtClave');

        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);

        $pedido = new Pedido();
        $aPedidos=$pedido->obtenerPorCliente(Session::get("idcliente"));


        if($cliente->idcliente > 0 && password_verify($clave, $cliente->clave)){

            $cliente->obtenerPorId($cliente->idcliente);
            Session::put("idcliente", $cliente->idcliente);
            return view("web.mi-cuenta", compact('cliente', 'aSucursales', 'aPedidos'));
            
        } else {
            $msg["msg"]= "Correo o clave incorrecto";
            $msg["estado"]= "danger";

            return view("web.login", compact('msg', 'aSucursales', 'pg'));

        }
      
       
    }
}