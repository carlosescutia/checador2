<?php

namespace App\Models;

use CodeIgniter\Model;

class Dia_inhabil_model extends Model
{
    protected $table = 'dia_inhabil';
    protected $primaryKey = 'id_dia_inhabil';
    protected $allowedFields = [
        'id_dia_inhabil',
        'fecha',
        'detalle',
    ];

    public function get_dias_inhabiles($anio) {
        $sql = 'select dh.* from dia_inhabil dh where extract(year from dh.fecha)::varchar = ? order by dh.fecha';
        $query = $this->db->query($sql, array($anio));
        return $query->getResultArray();
    }

    public function get_dia_inhabil($id_dia_inhabil) {
        $sql = 'select dh.* from dia_inhabil dh where id_dia_inhabil = ?;';
        $query = $this->db->query($sql, array($id_dia_inhabil));
        return $query->getRowArray();
    }

}
