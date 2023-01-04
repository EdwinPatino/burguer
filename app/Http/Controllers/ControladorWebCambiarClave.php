<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use Session;
class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $pg = "Cambiar clave";
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.cambiar-clave", compact('pg', 'aSucursales'));
    }

    public function guardar(Request $request){
      $pg = "Cambiar clave";
      $sucursal = new Sucursal();
      $aSucursales = $sucursal->obtenerTodos();


      $clave = $request->input('txtClave');
      $reClave = $request->input('txtReClave');

      if($clave == $reClave){
            $cliente = new Cliente();
            $cliente->obtenerPorId(Session::get('idcliente'));
            $cliente->clave = password_hash($clave, PASSWORD_DEFAULT);
            $cliente->guardar();
            $msg['estado'] = "success";
            $msg['msg'] = "Clave cambiada existosamente";
            return view("web.cambiar-clave", compact('pg', 'aSucursales', 'msg'));
      } else {
            $msg['estado'] = "danger";
            $msg['msg']= "Las claves no coinciden";
            return view("web.cambiar-clave", compact('pg', 'aSucursales', 'msg'));
      }

    }
}
