<?php

namespace App\Models;

use CodeIgniter\Model;

class Eventualidad_model extends Model
{
    protected $table = 'eventualidad';
    protected $primaryKey = 'id_eventualidad';
    protected $allowedFields = [
        'id_eventualidad',
        'nom_eventualidad',
    ];

    public function get_eventualidades()
    {
        $sql = ""
            ."select "
            ."e.* "
            ."from "
            ."eventualidad e "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_eventualidad($id_eventualidad)
    {
        $sql = ""
            ."select "
            ."e.* "
            ."from "
            ."eventualidad e "
            ."where "
            ."e.id_eventualidad = ? "
            ."";
        $query = $this->db->query($sql, array($id_eventualidad));
        return $query->getRowArray();
    }

}

