<?php

namespace App\Models;

use CodeIgniter\Model;

class Justificante_masivo_empleado_model extends Model
{
    protected $table = 'justificante_masivo_empleado';
    protected $primaryKey = 'id_justificante_masivo_empleado';
    protected $allowedFields = [
        'id_justificante_masivo_empleado',
        'id_justificante_masivo',
        'id_empleado',
    ];

    public function get_empleados_justificante_masivo($id_justificante_masivo) {
        $sql = ""
            ."select "
                ."string_agg(id_empleado::text, ',') as id_empleado "
            ."from "
                ."justificante_masivo_empleado jme "
            ."where "
                ."jme.id_justificante_masivo = ? "
            ."";
        $query = $this->db->query($sql, array($id_justificante_masivo));
        return $query->getRowArray()['id_empleado'] ?? null ;
    }

}

