<?php

namespace App\Models;

use CodeIgniter\Model;

class Periodo_vacacional_model extends Model
{
    protected $table = 'periodo_vacacional';
    protected $primaryKey = 'id_periodo_vacacional';
    protected $allowedFields = [
        'id_periodo_vacacional',
        'nom_periodo_vacacional',
        'orden',
    ];

    public function get_periodos_vacacionales()
    {
        $sql = ""
            ."select "
            ."p.* "
            ."from "
            ."periodo_vacacional p "
            ."order by orden "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_periodo_vacacional($id_periodo_vacacional)
    {
        $sql = ""
            ."select "
            ."u.* "
            ."from "
            ."periodo_vacacional u "
            ."where "
            ."u.id_periodo_vacacional = ? "
            ."";
        $query = $this->db->query($sql, array($id_periodo_vacacional));
        return $query->getRowArray();
    }

}

