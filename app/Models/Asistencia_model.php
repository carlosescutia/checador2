<?php

namespace App\Models;

use CodeIgniter\Model;

class Asistencia_model extends Model
{
    protected $table = 'asistencia';
    protected $primaryKey = 'id_asistencia';
    protected $allowedFields = [
        'id_asistencia',
        'id_empleado',
        'fecha',
        'hora',
    ];

    public function get_asistencias()
    {
        $sql = ""
            ."select "
            ."e.*, a.* "
            ."from "
            ."asistencia a "
            ."left join empleado e on e.id_empleado = a.id_empleado "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_anios_disponibles()
    {
        $sql = ""
            ."select "
            ."distinct(extract(year from fecha)) as anio "
            ."from "
            ."asistencia a "
            ."order by anio desc "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

}

