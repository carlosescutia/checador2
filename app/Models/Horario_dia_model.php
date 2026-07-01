<?php

namespace App\Models;

use CodeIgniter\Model;

class Horario_dia_model extends Model
{
    protected $table = 'horario_dia';
    protected $primaryKey = 'id_horario_dia';
    protected $allowedFields = [
        'id_horario_dia',
        'id_horario',
        'id_dia',
        'hora_entrada',
        'hora_salida',
    ];

    public function get_horarios_dias_empleado($id_empleado)
    {
        $sql = ""
            ."select "
                ."hd.*, d.nom_dia "
            ."from "
                ."horario_dia hd "
                ."left join horario h on h.id_horario = hd.id_horario "
                ."left join dia d on d.id_dia = hd.id_dia "
            ."where "
                ."h.id_empleado = ? "
            ."";
        $query = $this->db->query($sql, array($id_empleado));
        return $query->getResultArray();
    }


    public function get_horario_dia($id_horario_dia)
    {
        $sql = ""
            ."select "
                ."hd.*, d.nom_dia "
            ."from "
                ."horario_dia hd "
                ."left join dia d on d.id_dia = hd.id_dia "
            ."where "
                ."hd.id_horario_dia = ? "
            ."";
        $query = $this->db->query($sql, array($id_horario_dia));
        return $query->getRowArray();
    }

    public function get_horario_dias_horario($id_horario)
    {
        $sql = ""
            ."select "
                ."hd.*, d.nom_dia "
            ."from "
                ."horario_dia hd "
                ."left join dia d on d.id_dia = hd.id_dia "
            ."where "
                ."hd.id_horario = ? "
            ."";
        $query = $this->db->query($sql, array($id_horario));
        return $query->getResultArray();
    }

}
