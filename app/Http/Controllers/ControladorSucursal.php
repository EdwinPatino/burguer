<?php
namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva sucursal";

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALALTA")) {
                $codigo = "SUCURSALALTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $sucursal = new Sucursal();
                return view('sucursal.sucursal-nuevo', compact('titulo', 'sucursal'));
            }
        } else {
            return redirect('admin/login');
        }

    }

    public function index()
    {
        $titulo = "Listado de sucursales";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALCONSULTA")) {
                $codigo = "SUCURSALCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sucursal.sucursal-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursales = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSucursales) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/sucursal/".$aSucursales[$i]->idsucursal."' class='btn btn-secondary'><i class='fa-solid fa-pencil'></i></a>";
            $row[] = $aSucursales[$i]->nombre;
            $row[] = $aSucursales[$i]->telefono;
            $row[] = $aSucursales[$i]->direccion;
            $row[] = $aSucursales[$i]->linkmapa;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursales), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursales), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function guardar(Request $request) {
        try {
            //Define la entidad servicio
            $titulo = "Modificar sucursal";
            $entidad = new Sucursal();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }
         
                $_POST["id"] = $entidad->idsucursal;
                return view('sucursal.sucursal-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idsucursal;
        $sucursal = new Sucursal();
        $sucursal->obtenerPorId($id);

        return view('sucursal.sucursal-nuevo', compact('msg', 'sucursal', 'titulo')) . '?id=' . $sucursal->idsucursal;

    }
    public function editar($id)
    {
        $titulo = "Modificar Sucursal";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURUSALEDITAR")) {
                $codigo = "SUCURSALEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $sucursal = new Sucursal();
                $sucursal->obtenerPorId($id);

                return view('sucursal.sucursal-nuevo', compact('sucursal', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function eliminar(Request $request){
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("SUCURSALBAJA")) {

                $entidad = new Sucursal();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "SUCURSALBAJA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
}

?>