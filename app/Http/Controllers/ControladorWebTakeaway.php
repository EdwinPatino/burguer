<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Producto;
use App\Entidades\Categoria;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Carrito;
use App\Entidades\Carrito_producto;
use Session;

class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $pg = "takeaway";
        return view("web.takeaway", compact('pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));
    }


    public function agregarAlCarrito(Request $request){
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $pg = "takeaway";

        //asigna variables a los datos cargados en los input 
        $cantidadProducto = $request->input("txtCantidadProducto");
        $idProductoSelec = $request->input("txtIdProducto");
        //asignar la variable $idcliente = idcliente de la sesion.
        $idcliente = Session::get("idcliente");

        //si hay cliente logueado
        if($idcliente > 0){
            $carrito = new Carrito();
            $carrito_producto = new Carrito_producto();

            // si tiene carrito,
            if($carrito->obtenerPorCliente($idcliente) != null){
                $carrito_producto->fk_idcarrito = $carrito->idcarrito;
            } else {
            //si no tiene carrito asignado//crear un carrito con ese id de cliente. 
                $carrito->fk_idcliente = $idcliente;
                $carrito->insertar();
                $carrito_producto->fk_idcarrito = $carrito->idcarrito;
            }
            //agrega el id del producto y la cantidad obtenidaa en el input en carrito-productos
            $carrito_producto->fk_idproducto = $idProductoSelec;
            $carrito_producto->cantidad = $cantidadProducto;
            $carrito_producto->insertar();
            
            $msg["estado"] = "success";
            $msg["mensaje"] = "Añadiste un producto a tu carrito!";

            //insertar el id del carrito, cantidad y producto
            return view("web.takeaway", compact('msg', 'pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));
            
        } else { 
            
            $msg["estado"] = "danger";
            $msg["mensaje"] = "Antes de agregar un producto a tu carrito, debes loguearte.";
            return view("web.takeaway", compact('msg', 'pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));
        }
        

        
    }
           
}
