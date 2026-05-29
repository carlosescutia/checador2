<?php

namespace App\Models;

use CodeIgniter\Model;

class Recurso_model extends Model
{
    protected $table = 'recurso';
    protected $primaryKey = 'id_recurso';
    protected $allowedFields = [
        'nom_recurso',
        'url',
        'archivo',
        'activo',
    ];

    public function get_recursos_todos() {
        $sql = 'select * from recurso order by nom_recurso;';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_recursos_activos() {
        $sql = 'select * from recurso where activo = 1 order by nom_recurso;';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_recurso($id_recurso) {
        $sql = 'select * from recurso where id_recurso = ?;';
        $query = $this->db->query($sql, array($id_recurso));
        return $query->getRowArray();
    }

}
