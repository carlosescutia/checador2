<?php

namespace App\Models;

use CodeIgniter\Model;

class Justificante_masivo_model extends Model
{
    protected $table = 'justificante_masivo';
    protected $primaryKey = 'id_justificante_masivo';
    protected $allowedFields = [
        'id_justificante_masivo',
        'fecha',
        'detalle',
        'tipo_cobertura',
        'fech_fin',
    ];

    public function get_justificantes_masivos($mes, $anio) {
        $sql = ""
            ."select "
            ."jm.*, jmp.anio, p.nom_periodo_vacacional "
            ."from "
            ."justificante_masivo jm "
            ."left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm.id_justificante_masivo "
            ."left join periodo_vacacional p on p.id_periodo_vacacional = jmp.id_periodo_vacacional "
            ."where "
            ."extract(month from jm.fecha)::varchar = ? "
            ."and extract(year from jm.fecha)::varchar = ? "
            ."order by "
            ."fecha "
            ."";
        $query = $this->db->query($sql, array($mes, $anio));
        return $query->getResultArray();
    }

    public function get_justificante_masivo($id_justificante_masivo) {
        $sql = ""
            ."select "
            ."jm.*, jmp.id_justificante_masivo_periodo, jmp.id_periodo_vacacional, jmp.anio "
            ."from "
            ."justificante_masivo jm "
            ."left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm.id_justificante_masivo "
            ."where "
            ."jm.id_justificante_masivo = ? "
            ."";
        $query = $this->db->query($sql, array($id_justificante_masivo));
        return $query->getRowArray();
    }

}
