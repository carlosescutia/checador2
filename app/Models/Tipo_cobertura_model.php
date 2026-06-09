<?php

namespace App\Models;

use CodeIgniter\Model;

class Tipo_cobertura_model extends Model
{
    protected $table = 'tipo_cobertura';
    protected $primaryKey = 'id_tipo_cobertura';
    protected $allowedFields = [
        'id_tipo_cobertura',
        'cve_tipo_cobertura',
        'nom_tipo_cobertura',
    ];

    public function get_tipos_cobertura()
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_cobertura tc "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_tipo_cobertura($id_tipo_cobertura)
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_cobertura tc "
            ."where "
            ."tc.id_tipo_cobertura = ? "
            ."";
        $query = $this->db->query($sql, array($id_tipo_cobertura));
        return $query->getRowArray();
    }

}

