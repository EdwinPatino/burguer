<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
      protected $table = 'pedidos';
      public $timestamps = false;

      protected $fillable = [
            'idpedido', 
            'fecha', 
            'descripcion', 
            'total', 
            'fk_idsucursal', 
            'fk_idcliente', 
            'fk_idestado'
      ];
      protected $hidden = [

      ];
      public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        if($request->input('txtMes') && $request->input('txtMes') && $request->input('txtDia')){
            $this->fecha = $request->input('txtAnio') . "-" . $request->input('txtMes') . "-" . $request->input('txtDia');
        }
        $this->descripcion = $request->input('txtDescripcion');
        $this->total = $request->input('txtTotal');
        $this->fk_idsucursal = $request->input('lstSucursal');
        $this->fk_idcliente = $request->input('lstCliente');
        $this->fk_idestado = $request->input('lstEstado');
       
       
    }

      public function insertar()
      {
            $sql = "INSERT INTO $this->table (
                        fecha, 
                        descripcion, 
                        total, 
                        fk_idsucursal, 
                        fk_idcliente, 
                        fk_idestado
                  ) VALUES (?, ?, ?, ?, ?, ?);";
            $result = DB::insert($sql, [ 
                  $this->fecha,
                  $this->descripcion,
                  $this->total,
                  $this->fk_idsucursal,
                  $this->fk_idcliente,
                  $this->fk_idestado
            ]);
            return $this->idpedido = DB::getPdo()->lastInsertId();
      }

      public function guardar() 
      {
            $sql = "UPDATE pedidos SET
                fecha='$this->fecha',
                descripcion='$this->descripcion',
                total=$this->total,
                fk_idsucursal=$this->fk_idsucursal,
                fk_idcliente=$this->fk_idcliente,
                fk_idestado=$this->fk_idestado
                WHERE idpedido=?";
            $affected = DB::update($sql, [$this->idpedido]);
      }

      public function eliminar()
      {
        $sql = "DELETE FROM pedidos WHERE idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
      }

      public function obtenerTodos()
      {
            $sql = "SELECT
                  idpedido,
                  fecha,
                  descripcion,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado
                  FROM pedidos ORDER BY idpedido";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
      }

      public function obtenerPorId($idpedido)
    {
        $sql = "SELECT
                idpedido,
                fecha,
                descripcion,
                total,
                fk_idsucursal,
                fk_idcliente,
                fk_idestado
                FROM pedidos WHERE idpedido = $idpedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpedido',
            1 => 'A.fecha',
            2 => 'B.nombre',
            3 => 'C.nombre',
            4 => 'D.nombre',
            5 => 'A.total'
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.fecha,
                    A.descripcion,
                    B.nombre AS sucursal,
                    C.nombre AS cliente,
                    D.nombre AS estado,
                    A.fk_idsucursal,
                    A.fk_idcliente,
                    A.fk_idestado,
                    A.total
                    FROM pedidos A 
                    INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                    INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                    INNER JOIN estados D ON A.fk_idestado = D.idestado
                    
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR D.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.total LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
    public function obtenerPorCliente($idcliente){
            $sql = "SELECT
                       A.idpedido,
                       A.fecha,
                       A.descripcion,
                       A.total,
                       A.fk_idsucursal,
                       B.nombre AS sucursal,
                       A.fk_idcliente,
                       A.fk_idestado,
                       C.nombre AS estado
                   FROM pedidos A
                   INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                   INNER JOIN estados C ON A.fk_idestado = C.idestado
                    WHERE fk_idcliente = $idcliente AND A.fk_idestado <> 4";
           $lstRetorno = DB::select($sql);
           return $lstRetorno;
         
    }

    public function aprobar($idCliente) 
    {
        $sql = "UPDATE pedidos SET
            fk_idestado=2
            WHERE fk_idcliente=?";
        $affected = DB::update($sql, [$idCliente]);
    }
    public function pendiente($idCliente) 
    {
        $sql = "UPDATE pedidos SET
            fk_idestado=10
            WHERE fk_idcliente=?";
        $affected = DB::update($sql, [$idCliente]);
    }
    public function error($idCliente) 
    {
        $sql = "UPDATE pedidos SET
            fk_idestado=11
            WHERE fk_idcliente=?";
        $affected = DB::update($sql, [$idCliente]);
    }

}