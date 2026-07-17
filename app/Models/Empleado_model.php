<?php

namespace App\Models;

use CodeIgniter\Model;

class Empleado_model extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $allowedFields = [
        'id_empleado',
        'nom_empleado',
        'cod_empleado',
        'activo',
        'correo',
        'id_usuario',
    ];

    public function get_empleados($filtro)
    {
        switch ($filtro) {
            case 'activos':
                $condicion = "where activo = 1 ";
                break;
            case 'inactivos':
                $condicion = "where coalesce(activo, 0) = 0 ";
                break;
            case 'todos':
                $condicion = "";
                break;
            default:
                $condicion = "";
        }

        $sql = ""
            ."select "
                ."e.* "
            ."from "
                ."empleado e "
            ."";
        $sql .= $condicion;
        $sql .= ""
            ."order by "
                ."nom_empleado "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_empleado($id_empleado)
    {
        $sql = ""
            ."select "
            ."e.* "
            ."from "
            ."empleado e "
            ."where "
            ."e.id_empleado = ? "
            ."";
        $query = $this->db->query($sql, array($id_empleado));
        return $query->getRowArray();
    }

    public function get_empleados_reporte($filtro_activo, $id_empleado, $id_rol)
    {
        $sql = ""
            ."select "
                ."e.* "
            ."from "
                ."empleado e "
            ."where "
                ."true "
            ."";

        if ( $id_rol == 'empleado' ) {
            $filtro_empleado = 'and e.id_empleado = ' . $id_empleado . ' ';
        } else {
            $filtro_empleado = '';
        }

        $sql .= $filtro_empleado;

        switch ($filtro_activo) {
            case 'activos':
                $condicion = "and activo = 1 ";
                break;
            case 'inactivos':
                $condicion = "and coalesce(activo, 0) = 0 ";
                break;
            case 'todos':
                $condicion = "";
                break;
            default:
                $condicion = "";
        }

        $sql .= $condicion;
        $sql .= ""
            ."order by "
                ."nom_empleado "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();

    }

}
