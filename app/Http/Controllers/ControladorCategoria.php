<?php

namespace App\Http\Controllers;

use App\Entidades\Categoria;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorCategoria extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva categoria"; 

        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CATEGORIACONSULTA")) {
                $codigo = "CATEGORIACONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $categoria = new Categoria();
                return view('categoria.categoria-nuevo', compact('titulo', 'categoria'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function index()
    {
        $titulo = "Listado de Categorias";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CATEGORIACONSULTA")) {
                $codigo = "CATEGORIACONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('categoria.categoria-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Categoria();
        $aCategorias = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aCategorias) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/categoria/".$aCategorias[$i]->idcategoria."' class='btn btn-secondary'><i class='fa-solid fa-pencil'></i></a>";
            $row[] = $aCategorias[$i]->nombre;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aCategorias), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aCategorias), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
    public function guardar(Request $request) {
        try {
            //Define la entidad servicio
            $titulo = "Modificar categoria";
            $entidad = new Categoria();
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
         
                $_POST["id"] = $entidad->idcategoria;
                return view('categoria.categoria-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->categoria;
        $categoria = new Categoria();
        $categoria->obtenerPorId($id);

        return view('categoria.categoria-nuevo', compact('msg', 'categoria', 'titulo')) . '?id=' . $categoria->idcategoria;

    }
    public function editar($id)
    {
        $titulo = "Modificar categoria";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CATEGORIAMODIFICACION")) {
                $codigo = "CATEGORIAMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $categoria = new Categoria();
                $categoria->obtenerPorId($id);

                return view('categoria.categoria-nuevo', compact('categoria', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function eliminar(Request $request){
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("CATEGORIAELIMINAR")) {

                $entidad = new Categoria();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "CATEGORIAELIMINAR";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
}
