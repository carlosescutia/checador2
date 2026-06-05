<?php

namespace App\Models;

use CodeIgniter\Model;

class Incidente_model extends Model
{
    public function get_lista_incidentes_empleados_todos($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia)
    {
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = 'select e.id_empleado, e.cod_empleado, e.nom_empleado, h.nom_horario, count(j.cve_tipo_incidente) as num_incidentes from empleado e left join justificacion_periodo(?,?,?,?) j on j.id_empleado = e.id_empleado and j.cve_tipo_incidente is not null and j.tipo_justificante is null left join horario h on e.id_horario = h.id_horario where e.activo = 1 group by e.id_empleado, e.cod_empleado, e.nom_empleado, h.nom_horario order by e.nom_empleado';
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia));
        return $query->getResultArray();
    }

    public function get_incidentes_empleado($id_empleado, $mes, $anio, $tolerancia_retardo, $tolerancia_asistencia)
    {
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select  "
                ."j.id_empleado, j.fecha, j.hora_entrada, j.hora_salida, j.cve_tipo_incidente, ti.nom_tipo_incidente, j.tipo_justificante, j.id_justificante "
                .",( "
                    ."select 'dia inhabil' from dia_inhabil di where j.tipo_justificante = 'di' and j.id_justificante = di.id_dia_inhabil "
                    ."union "
                    ."select case when tipo_cobertura = 'dia' then 'dia masivo justificado' when tipo_cobertura = 'entrada' then 'entrada masiva justificada' when tipo_cobertura = 'salida' then 'salida masiva justificada' when tipo_cobertura = 'vacaciones' then 'vacaciones' end from justificante_masivo jm where j.tipo_justificante = 'jm' and j.id_justificante = jm.id_justificante_masivo "
                    ."union "
                    ."select case when tipo_cobertura = 'vacaciones' then 'vacaciones' when tipo_cobertura = 'salida' then 'salida justificada' when tipo_cobertura = 'entrada' then 'entrada justificada' when tipo_cobertura = 'dia' then 'dia justificado' end from justificante ji where j.tipo_justificante = 'ji' and j.id_justificante = ji.id_justificante "
                    ."union "
                    ."select 'fuera de horario' where j.tipo_justificante = 'hc' "
                .") as desc_corta_justificante "
                .",( "
                    ."select di.detalle from dia_inhabil di where j.tipo_justificante = 'di' and j.id_justificante = di.id_dia_inhabil "
                    ."union "
                    ."select coalesce(p.nom_periodo_vacacional, '') || ' ' || coalesce(jmp.anio::text, '') || ' ' || jm.detalle from justificante_masivo jm left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm.id_justificante_masivo left join periodo_vacacional p on p.id_periodo_vacacional = jmp.id_periodo_vacacional where j.tipo_justificante = 'jm' and j.id_justificante = jm.id_justificante_masivo "
                    ."union "
                    ."select coalesce(p.nom_periodo_vacacional,'') || ' ' || coalesce(jp.anio::text,'') || ' ' || ji.detalle from justificante ji left join justificante_periodo jp on jp.id_justificante = j.id_justificante left join periodo_vacacional p on p.id_periodo_vacacional = jp.id_periodo_vacacional where j.tipo_justificante = 'ji' and j.id_justificante = ji.id_justificante "
                    ."union "
                    ."select 'Cumple horas de trabajo' where j.tipo_justificante = 'hc' "
                .") as detalle "
            ."from  "
                ."justificacion_periodo(?,?,?,?) j  "
                ."left join tipo_incidente ti on ti.cve_tipo_incidente = j.cve_tipo_incidente "
            ."where  "
                ."j.id_empleado = ? "
            ."order by "
                ."j.fecha "
            ;
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado));
        return $query->getResultArray();
    }

}

