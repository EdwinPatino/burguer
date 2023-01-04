<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{

    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion',
        'nombre',
        'apellido',
        'celular',
        'correo',
        'curriculum'
    ];
    protected $hidden = [

    ];
     public function cargarDesdeRequest($request)
    {
        $this->idpostulacion = $request->input('id') != "0" ? $request->input('id') : $this->idpostulacion;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->correo = $request->input('txtCorreo');
        $this->celular = $request->input('txtCelular');
        $this->curriculum = "";
    }

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                  nombre,
                  apellido,
                  celular,
                  correo,
                  curriculum

            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum,

        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorId($idpostulacion)
    {
        $sql = "SELECT
                idpostulacion,
                nombre,
                apellido,
                celular,
                correo,
                curriculum
                FROM $this->table WHERE idpostulacion = $idpostulacion";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->celular = $lstRetorno[0]->celular;
            $this->correo = $lstRetorno[0]->correo;
            $this->curriculum = $lstRetorno[0]->curriculum;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE $this->table SET
          nombre='$this->nombre',
          apellido='$this->apellido',
          celular='$this->celular',
          correo='$this->correo',
          curriculum='$this->curriculum'
          WHERE idpostulacion=?";
        $affected = DB::update($sql, [$this->idpostulacion]);

    }
    public function eliminar()
    {
        $sql = "DELETE FROM $this->table WHERE idpostulacion=?";
        $affected = DB::delete($sql, [$this->idpostulacion]);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                A.idpostulacion,
                A.nombre,
                A.apellido,
                A.celular,
                A.correo,
                A.curriculum
                FROM $this->table A ORDER BY A.idpostulacion DESC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

     public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpostulacion',
            1 => 'A.nombre',
            2 => 'A.apellido',
            3 => 'A.correo',
            4 => 'A.celular'
        );
        $sql = "SELECT DISTINCT
                    A.idpostulacion,
                    A.nombre,
                    A.apellido,
                    A.celular,
                    A.correo,
                    A.curriculum
                    FROM postulaciones A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.celular LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}
