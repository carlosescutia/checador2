<?php

namespace App\Models;

use CodeIgniter\Model;

class Justificante_model extends Model
{
    protected $table = 'justificante';
    protected $primaryKey = 'id_justificante';
    protected $allowedFields = [
        'id_justificante',
        'id_empleado',
        'fecha',
        'tipo_cobertura',
        'detalle',
        'id_eventualidad',
        'fech_fin',
    ];

    public function get_vacaciones_empleado($anio, $id_empleado)
    {
        $sql = ""
                ."select  "
                    ."j.id_justificante, j.id_empleado, j.fecha, j.tipo_cobertura, 'ji' as tipo_justificante, j.detalle, j.fech_fin, num_dias_habiles_periodo(j.fecha, coalesce(j.fech_fin, j.fecha)) as dias, jp.anio, p.nom_periodo_vacacional "
                ."from  "
                    ."justificante j "
                    ."left join justificante_periodo jp on jp.id_justificante = j.id_justificante "
                    ."left join periodo_vacacional p on p.id_periodo_vacacional = jp.id_periodo_vacacional "
                ."where  "
                    ."extract(year from j.fecha) = ? "
                    ."and j.id_empleado = ?  "
                    ."and j.tipo_cobertura = 'vacaciones'  "
            ."union "
                ."select  "
                    ."jm.id_justificante_masivo, ? as id_empleado, jm.fecha, jm.tipo_cobertura, 'jm' as tipo_justificante, jm.detalle, jm.fech_fin, num_dias_habiles_periodo(jm.fecha, coalesce(jm.fech_fin, jm.fecha)) as dias, jmp.anio, p.nom_periodo_vacacional "
                ."from  "
                    ."justificante_masivo jm "
                    ."left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm.id_justificante_masivo "
                    ."left join periodo_vacacional p on p.id_periodo_vacacional = jmp.id_periodo_vacacional "
                ."where  "
                    ."? between extract(year from jm.fecha) and extract(year from jm.fech_fin) and jm.id_justificante_masivo not in (select distinct id_justificante_masivo from justificante_masivo_empleado) "
                    ."and jm.tipo_cobertura = 'vacaciones'  "
            ."union "
                ."select  "
                    ."jm2.id_justificante_masivo, ? as id_empleado, jm2.fecha, jm2.tipo_cobertura, 'jm' as tipo_justificante, jm2.detalle, jm2.fech_fin, num_dias_habiles_periodo(jm2.fecha, coalesce(jm2.fech_fin, jm2.fecha)) as dias, jmp.anio, p.nom_periodo_vacacional "
                ."from  "
                    ."justificante_masivo jm2 "
                    ."left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm2.id_justificante_masivo "
                    ."left join periodo_vacacional p on p.id_periodo_vacacional = jmp.id_periodo_vacacional "
                ."where  "
                    ."? between extract(year from jm2.fecha) and extract(year from jm2.fech_fin) and ? in (select jme.id_empleado from justificante_masivo_empleado jme where jme.id_justificante_masivo = jm2.id_justificante_masivo) "
                    ."and jm2.tipo_cobertura = 'vacaciones'  "
            ."order by  "
                ."fecha  "
            ."";
        $query = $this->db->query($sql, array($anio, $id_empleado, $id_empleado, $anio, $id_empleado, $anio, $id_empleado));
        return $query->getResultArray();
    }

    public function get_justificantes_empleado($mes, $anio, $id_empleado)
    {
        $sql = ""
            ."select  "
                ."j.*, "
                ."num_dias_habiles_periodo(j.fecha, coalesce(j.fech_fin, j.fecha)) as dias, "
                ."e.nom_eventualidad "
            ."from  "
                ."justificante j "
                ."left join eventualidades e on e.id_eventualidad = j.id_eventualidad "
            ."where  "
                ."extract(month from j.fecha) = ?  "
                ."and extract(year from j.fecha) = ?  "
                ."and j.id_empleado = ?  "
                ."and j.tipo_cobertura in ('entrada','salida','dia')  "
            ."order  "
                ."by j.fecha  "
            ."";
        $query = $this->db->query($sql, array($mes, $anio, $id_empleado));
        return $query->getResultArray();
    }

    public function get_justificante($id_justificante)
    {
        $sql = ""
            ."select "
                ."j.*, jp.id_justificante_periodo, jp.id_periodo_vacacional, jp.anio "
            ."from "
                ."justificante j "
                ."left join justificante_periodo jp on jp.id_justificante = j.id_justificante "
            ."where "
                ."j.id_justificante = ? "
            ."";
        $query = $this->db->query($sql, array($id_justificante));
        return $query->getRowArray();
    }

}
