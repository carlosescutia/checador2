<?php

namespace App\Models;

use CodeIgniter\Model;

class Horario_model extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    protected $allowedFields = [
        'id_horario',
        'id_empleado',
        'fech_ini',
        'fech_fin',
    ];

    public function get_horarios()
    {
        $sql = ""
            ."select "
                ."h.* "
            ."from "
                ."horario h "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_horarios_activos_empleado($id_empleado)
    {
        $sql = ""
            ."select "
                ."h.* "
            ."from "
                ."horario h "
            ."where "
                ."h.id_empleado = ? "
                ."and current_date between h.fech_ini and h.fech_fin "
            ."order by "
                ."h.fech_ini desc "
            ."";
        $query = $this->db->query($sql, array($id_empleado));
        return $query->getResultArray();
    }

    public function get_horarios_inactivos_empleado($id_empleado)
    {
        $sql = ""
            ."select "
                ."h.* "
            ."from "
                ."horario h "
            ."where "
                ."h.id_empleado = ? "
                ."and current_date not between h.fech_ini and h.fech_fin "
            ."order by "
                ."h.fech_ini desc "
            ."";
        $query = $this->db->query($sql, array($id_empleado));
        return $query->getResultArray();
    }

    public function get_horario($id_horario)
    {
        $sql = ""
            ."select "
                ."h.* "
            ."from "
                ."horario h "
            ."where "
                ."h.id_horario = ? "
            ."";
        $query = $this->db->query($sql, array($id_horario));
        return $query->getRowArray();
    }

}

