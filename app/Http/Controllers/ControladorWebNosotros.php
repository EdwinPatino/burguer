<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $pg = "nosotros";
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.nosotros", compact('pg', 'aSucursales'));
    }

    public function enviar(Request $request)
    {
        $nombre = $request->input('txtNombre');
        $celular = $request->input('txtTelefono');
        $correo = $request->input('txtCorreo');
        $mensaje = $request->input('txtMensaje');
        $postulacion = new Postulacion();
        $postulacion->curriculum = "";

        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            $nombreRandom = date("Ymdhmsi") . ".$extension"; //genera un nombreRandom con año, fecha y hora
            $archivo_tmp = $_FILES["archivo"]["tmp_name"];
        
            if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {;
                move_uploaded_file($archivo_tmp, env('APP_PATH') . "/public/files/$nombreRandom"); //guarda el archivo fisicamente
                $postulacion->curriculum = $nombreRandom;
            }
        }
        $postulacion->nombre = $nombre;
        $postulacion->apellido = "";
        $postulacion->celular = $celular;
        $postulacion->correo = $correo;
        $postulacion->mensaje = $mensaje;
        $postulacion->insertar();

        return redirect("/gracias-postulacion");
    }

}
