<?php

namespace App\Models;

use CodeIgniter\Model;

class Empleado_model extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $allowedFields = [
        'id_empleado',
        'cod_empleado',
        'nom_empleado',
        'activo',
        'id_horario',
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

}

