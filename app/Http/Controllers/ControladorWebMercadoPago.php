<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;

class ControladorWebMercadoPago extends Controller
{
    public function aprobar($idCliente)
    {
      $pedido = new Pedido();
      $pedido->aprobar($idCliente);
      return redirect("/mi-cuenta");
    }
    public function pendiente($idCliente)
    {
      $pedido = new Pedido();
      $pedido->pendiente($idCliente);
      return redirect("/mi-cuenta");
    }
    public function error($idCliente)
    {
      $pedido = new Pedido();
      $pedido->error($idCliente);
      return redirect("/mi-cuenta");
    }
}
