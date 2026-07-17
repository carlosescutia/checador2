<?php

namespace App\Models;

use CodeIgniter\Model;

class Incidente_model extends Model
{
    public function get_lista_incidentes_empleados_todos($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia)
    {
        // listado de incidentes de empleados activos
        // devuelve nom_empleado y num_incidentes
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select "
                ."e.id_empleado, e.cod_empleado, e.nom_empleado, count(j.cve_tipo_incidente) as num_incidentes "
            ."from "
                ."empleado e "
                ."left join justificacion_periodo(?,?,?,?) j on j.id_empleado = e.id_empleado and j.cve_tipo_incidente is not null and j.tipo_justificante is null "
            ."where "
                ."e.activo = 1 "
            ."group by "
                ."e.id_empleado, e.cod_empleado, e.nom_empleado "
            ."order by "
                ."e.nom_empleado"
            ."";
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia));
        return $query->getResultArray();
    }

    public function get_incidentes_empleado($id_empleado, $mes, $anio, $tolerancia_retardo, $tolerancia_asistencia)
    {
        // detalle de incidentes de un empleado
        // devuelve incidentes y justificantes
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select  "
                ."j.id_empleado, j.fecha, j.hora_entrada, j.hora_salida, j.horario_entrada, j.horario_salida, j.cve_tipo_incidente, j.cve_tipo_cobertura, ti.nom_tipo_incidente, j.tipo_justificante, j.id_justificante "
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

    public function get_num_incidentes_empleado($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado)
    {
        // numero de incidentes de un empleado
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select "
                ."count(j.cve_tipo_incidente) as num_incidentes "
            ."from "
                ."empleado e "
                ."left join justificacion_periodo(?,?,?,?) j on j.id_empleado = e.id_empleado and j.cve_tipo_incidente is not null and j.tipo_justificante is null "
            ."where "
                ."e.id_empleado = ? "
                ."and e.activo = 1 "
            ."";
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado));
        return $query->getRowArray()['num_incidentes'] ?? null ;
    }

    public function get_incidentes_empleados_mes($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol, $salida)
    {
        // incidentes de empleados activos por mes - nuevo: parametrizado para mostrar todos (operador) o individual (empleado)
        // devuelve incidentes y justificantes
        $dbutil = \Config\Database::utils();

        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select  "
                ."j.id_empleado, j.fecha, j.hora_entrada, j.hora_salida, j.horario_entrada, j.horario_salida, j.cve_tipo_incidente, j.cve_tipo_cobertura, ti.nom_tipo_incidente, j.tipo_justificante, j.id_justificante "
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
                        ."select coalesce(p.nom_periodo_vacacional,'') || ' ' || coalesce(jmp.anio::text,'') || ' ' || jm.detalle from justificante_masivo jm left join justificante_masivo_periodo jmp on jmp.id_justificante_masivo = jm.id_justificante_masivo left join periodo_vacacional p on p.id_periodo_vacacional = jmp.id_periodo_vacacional where j.tipo_justificante = 'jm' and j.id_justificante = jm.id_justificante_masivo "
                    ."union "
                        ."select coalesce(p.nom_periodo_vacacional,'') || ' ' || coalesce(jp.anio::text,'') || ' ' || ji.detalle from justificante ji left join justificante_periodo jp on jp.id_justificante = j.id_justificante left join periodo_vacacional p on p.id_periodo_vacacional = jp.id_periodo_vacacional where j.tipo_justificante = 'ji' and j.id_justificante = ji.id_justificante "
                    ."union "
                        ."select 'Cumple horas de trabajo' where j.tipo_justificante = 'hc' "
                .") as desc_justificante "
            ."from  "
                ."justificacion_periodo(?,?,?,?) j  "
                ."left join tipo_incidente ti on ti.cve_tipo_incidente = j.cve_tipo_incidente "
            ."";

        $parametros = array();
        array_push($parametros, "$fech_ini");
        array_push($parametros, "$fech_fin");
        array_push($parametros, "$tolerancia_retardo");
        array_push($parametros, "$tolerancia_asistencia");

        if ( $id_rol == 'empleado' ) {
            $filtro_empleado = 'where j.id_empleado = ' . $id_empleado;
        } else {
            $filtro_empleado = '';
        }

        $sql .= $filtro_empleado;
        $sql .= ' order by j.fecha, j.cve_tipo_cobertura ';
        $query = $this->db->query($sql, $parametros);

        if ($salida == 'csv') {
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            return $dbutil->getCSVFromResult($query, $delimiter, $newline, $enclosure);
        } else {
            return $query->getResultArray();
        }
    }

    public function get_num_incidentes_empleados_mes($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia)
    {
        // número incidentes de empleados activos por mes - nuevo: parametrizado para calcular todos (operador) o individual (empleado)
        $fech_ini = $anio . "-" . $mes . "-01";
        $fech_fin = date("Y-m-t", strtotime($fech_ini));
        $sql = ""
            ."select "
                ."e.id_empleado, count(j.cve_tipo_incidente) as num_incidentes "
            ."from "
                ."empleado e "
                ."left join justificacion_periodo(?,?,?,?) j on j.id_empleado = e.id_empleado and j.cve_tipo_incidente is not null and j.tipo_justificante is null "
            ."where "
                ."e.activo = 1 "
            ."group by "
                ."e.id_empleado "
            ."";
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia));
        return $query->getResultArray() ;
    }

    public function get_incidentes_empleados_periodo($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol, $salida)
    {
        // incidentes de empleados activos por periodo
        // devuelve incidentes
        // NO DEVUELVE JUSTIFICANTES
        $dbutil = \Config\Database::utils();

        $sql = ""
            ."select  "
                ."j.id_empleado, j.fecha, j.hora_entrada, j.hora_salida, j.horario_entrada, j.horario_salida, j.cve_tipo_incidente, j.cve_tipo_cobertura, ti.nom_tipo_incidente, j.tipo_justificante, j.id_justificante "
            ."from  "
                ."justificacion_periodo(?,?,?,?) j  "
                ."left join tipo_incidente ti on ti.cve_tipo_incidente = j.cve_tipo_incidente "
            ."where "
                ."coalesce(j.cve_tipo_incidente, '') <> '' "
                ."and coalesce(j.id_justificante, 0) = 0 "
            ;

        $parametros = array();
        array_push($parametros, "$fech_ini");
        array_push($parametros, "$fech_fin");
        array_push($parametros, "$tolerancia_retardo");
        array_push($parametros, "$tolerancia_asistencia");

        if ( $id_rol == 'empleado' ) {
            $filtro_empleado = 'and j.id_empleado = ' . $id_empleado;
        } else {
            $filtro_empleado = '';
        }

        $sql .= $filtro_empleado;
        $sql .= ' order by j.fecha, j.cve_tipo_cobertura ';
        $query = $this->db->query($sql, $parametros);

        //$query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia));

        if ($salida == 'csv') {
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            return $dbutil->getCSVFromResult($query, $delimiter, $newline, $enclosure);
        } else {
            return $query->getResultArray();
        }
    }

    public function get_num_incidentes_empleados_periodo($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia)
    {
        // número incidentes de empleados activos por periodo
        $sql = ""
            ."select "
                ."e.id_empleado, count(j.cve_tipo_incidente) as num_incidentes "
            ."from "
                ."empleado e "
                ."left join justificacion_periodo(?,?,?,?) j on j.id_empleado = e.id_empleado and j.cve_tipo_incidente is not null and j.tipo_justificante is null "
            ."where "
                ."e.activo = 1 "
            ."group by "
                ."e.id_empleado "
            ."";
        $query = $this->db->query($sql, array($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia));
        return $query->getResultArray() ;
    }

}
