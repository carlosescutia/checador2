<?php

namespace App\Models;

use CodeIgniter\Model;

class Tipo_incidente_model extends Model
{
    protected $table = 'tipo_incidente';
    protected $primaryKey = 'id_tipo_incidente';
    protected $allowedFields = [
        'id_tipo_incidente',
        'cve_tipo_incidente',
        'nom_tipo_incidente',
    ];

    public function get_tipos_incidente()
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_incidente tc "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_tipo_incidente($id_tipo_incidente)
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_incidente tc "
            ."where "
            ."tc.id_tipo_incidente = ? "
            ."";
        $query = $this->db->query($sql, array($id_tipo_incidente));
        return $query->getRowArray();
    }

}

