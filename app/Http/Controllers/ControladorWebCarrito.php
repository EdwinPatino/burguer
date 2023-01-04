<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Carrito;
use App\Entidades\Pedido;
use App\Entidades\Carrito_producto;
use Session;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idcliente = Session::get("idcliente");

        //si hay cliente logueado
        if($idcliente > 0){
            $carrito = new Carrito();
            

            // si tiene carrito,
            if($carrito->obtenerPorCliente($idcliente) != null){
                $carrito_producto = new Carrito_producto();
                if($carrito_producto->obtenerPorCarrito($carrito->idcarrito) != null){
                    $idcarrito=$carrito->idcarrito;
                    $aCarrito_productos = $carrito_producto->obtenerPorCarrito($idcarrito);
                    } else {
                        $aCarrito_productos = array();
                    }
            } else {
            //si no tiene carrito asignado//mostrar alerta: "su carrito esta vacio"
                $msg["estado"] = "info";
                $msg["mensaje"]="Su carrito esta vacio, agregue productos desde Takeaway";
            }
         

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $pg = "carrito";
        return view("web.carrito", compact('pg', 'carrito', 'carrito_producto', 'aSucursales', 'aCarrito_productos'));
        }
    }

    public function finalizarPedido(Request $request){
        $pedido = new Pedido();
        $pedido->fecha = Date("Y-m-d H:i:s");
        $medioDePago =  $request->input('lstMedioDePago');

        $carrito_producto = new Carrito_producto();
        $aCarritoProductos = $carrito_producto->obtenerPorCliente(Session::get("idcliente"));

        foreach ($aCarritoProductos as $carrito) {
            $pedido->descripcion .= $carrito->producto . " - ";
            $pedido->total = $carrito->cantidad * $carrito->precio;
        }

        $pedido->fk_idsucursal = $request->input('lstSucursal');
        $pedido->fk_idcliente = Session::get("idcliente");

        if($medioDePago == "sucursal"){
            $pedido->fk_idestado = PEDIDO_PENDIENTE;
            $pedido->insertar();
        } else {
            $pedido->fk_idestado = PEDIDO_PENDIENTEDEPAGO;
            $pedido->insertar();

            //Abona por MP
            $access_token = "";
            SDK::setClientId(config("payment-methods.mercadopago.client"));
            SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
            SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

            //Armado del producto ‘item’
            $item = new Item();
            $item->id = "1234";
            $item->title = "Burger SRL";
            $item->category_id = "products";
            $item->quantity = 1;
            $item->unit_price = $pedido->total;
            $item->currency_id = "ARS"; //COP

            $preference = new Preference();
            $preference->items = array($item);

            //Datos del comprador
            $payer = new Payer();
            $cliente = new Cliente();
            $cliente->obtenerPorId(Session::get("idcliente"));
            $payer->name = $cliente->nombre;
            $payer->surname = $cliente->apellido;
            $payer->email = $cliente->correo;
            $payer->date_created = date('Y-m-d H:m:s');
            $payer->identification = array(
                "type" => "DNI", //CC
                "number" => $cliente->dni,
            );
            $preference->payer = $payer;

            //URL de configuración para indicarle a MP
            $preference->back_urls = [
                "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $cliente->idcliente,
                "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $cliente->idcliente,
                "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $cliente->idcliente,
            ];

            $preference->payment_methods = array("installments" => 6);
            $preference->auto_return = "all";
            $preference->notification_url = '';
            $preference->save(); //Ejecuta la transacción
        }

        //Vaciar el carrito
        $carrito_producto->eliminarPorCliente(Session::get("idcliente"));

        $carrito = new Carrito();
        $carrito->eliminarPorCliente(Session::get("idcliente"));

        return redirect("/mi-cuenta");
    }

}
?>