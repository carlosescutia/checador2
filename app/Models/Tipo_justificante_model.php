<?php

namespace App\Models;

use CodeIgniter\Model;

class Tipo_justificante_model extends Model
{
    protected $table = 'tipo_justificante';
    protected $primaryKey = 'id_tipo_justificante';
    protected $allowedFields = [
        'id_tipo_justificante',
        'cve_tipo_justificante',
        'nom_tipo_justificante',
    ];

    public function get_tipos_justificante()
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_justificante tc "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_tipo_justificante($id_tipo_justificante)
    {
        $sql = ""
            ."select "
            ."tc.* "
            ."from "
            ."tipo_justificante tc "
            ."where "
            ."tc.id_tipo_justificante = ? "
            ."";
        $query = $this->db->query($sql, array($id_tipo_justificante));
        return $query->getRowArray();
    }

}

