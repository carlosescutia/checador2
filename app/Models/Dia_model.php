<?php

namespace App\Models;

use CodeIgniter\Model;

class Dia_model extends Model
{
    protected $table = 'dia';
    protected $primaryKey = 'id_dia';
    protected $allowedFields = [
        'id_dia',
        'nom_dia',
    ];

    public function get_dias()
    {
        $sql = ""
            ."select "
                ."d.* "
            ."from "
                ."dia d "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_dia($id_dia)
    {
        $sql = ""
            ."select "
                ."d.* "
            ."from "
                ."dia d "
            ."where "
                ."d.id_dia = ? "
            ."";
        $query = $this->db->query($sql, array($id_dia));
        return $query->getRowArray();
    }

}

