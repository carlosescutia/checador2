<?php

namespace App\Models;

use CodeIgniter\Model;

class Justificante_periodo_model extends Model
{
    protected $table = 'justificante_periodo';
    protected $primaryKey = 'id_justificante_periodo';
    protected $allowedFields = [
        'id_justificante_periodo',
        'id_justificante',
        'id_periodo_vacacional',
        'anio',
    ];

    public function get_justificantes_periodo()
    {
        $sql = ""
            ."select "
            ."jp.* "
            ."from "
            ."justificante_periodo jp "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_justificante_periodo($id_justificante_periodo)
    {
        $sql = ""
            ."select "
            ."jp.* "
            ."from "
            ."justificante_periodo jp "
            ."where "
            ."jp.id_justificante_periodo = ? "
            ."";
        $query = $this->db->query($sql, array($id_justificante_periodo));
        return $query->getRowArray();
    }

}

