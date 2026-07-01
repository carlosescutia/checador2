<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ImportOld extends Seeder
{
    public function run()
    {
        /*
        * ImportOld
        * importa base de datos de sistema checador anterior
        */

        /*
        --------
        truncado
        --------
        */
        $this->db->query('truncate bitacora restart identity');

        /*
        ------------------
        seeding de catalogos de aplicación
        ------------------
        */
        $this->db->query('truncate tipo_incidente restart identity');
        $this->call('TipoIncidenteSeeder');

        $this->db->query('truncate tipo_justificante restart identity');
        $this->call('TipoJustificanteSeeder');

        $this->db->query('truncate tipo_cobertura restart identity');
        $this->call('TipoCoberturaSeeder');

        $this->db->query('truncate dia restart identity');
        $this->call('DiaSeeder');

        /*
        ------------------
        truncado y seeding con base de datos anterior
        ------------------
        */

        /* catalogos */
        $this->db->query('truncate empleado restart identity cascade');
        $this->db->query('insert into empleado (id_empleado, cod_empleado, nom_empleado, activo)
            select cve_empleado, cod_empleado, nom_empleado, activo from old.empleados');
        $this->db->query("select setval(pg_get_serial_sequence('empleado', 'id_empleado'), (select max(id_empleado) from empleado))");

        $this->db->query('truncate periodo_vacacional restart identity');
        $this->db->query('insert into periodo_vacacional (id_periodo_vacacional, nom_periodo_vacacional, orden)
            select id_periodo, nom_periodo, orden from old.periodos');
        $this->db->query("select setval(pg_get_serial_sequence('periodo_vacacional', 'id_periodo_vacacional'), (select max(id_periodo_vacacional) from periodo_vacacional))");

        $this->db->query('truncate eventualidad restart identity');
        $this->db->query('insert into eventualidad (id_eventualidad, nom_eventualidad)
            select cve_eventualidad, nom_eventualidad from old.eventualidades');
        $this->db->query("select setval(pg_get_serial_sequence('eventualidad', 'id_eventualidad'), (select max(id_eventualidad) from eventualidad))");

        /* registros */
        $this->db->query('truncate horario restart identity cascade');
        $this->db->query('insert into horario (id_horario, id_empleado, fech_ini, fech_fin)
            select id_horario_especial, cve_empleado, fech_ini, fech_fin from old.horarios_especiales');
        $this->db->query("select setval(pg_get_serial_sequence('horario', 'id_horario'), (select max(id_horario) from horario))");

        $this->db->query('truncate horario_dia restart identity');
        $this->db->query('insert into horario_dia (id_horario, id_dia, hora_entrada, hora_salida)
            select hed.id_horario_especial, hed.cve_dia, h.hora_entrada, h.hora_salida from old.horarios_especiales_dias hed left join old.horarios h on h.cve_horario = hed.cve_horario');
        $this->db->query("select setval(pg_get_serial_sequence('horario', 'id_horario'), (select max(id_horario) from horario))");

        $this->db->query('truncate asistencia restart identity');
        $this->db->query('insert into asistencia (id_asistencia, id_empleado, fecha, hora)
            select cve_asistencia, cve_empleado, fecha, hora from old.asistencias');
        $this->db->query("select setval(pg_get_serial_sequence('asistencia', 'id_asistencia'), (select max(id_asistencia) from asistencia))");

        $this->db->query('truncate justificante restart identity cascade');
        $this->db->query('insert into justificante (id_justificante, id_empleado, fecha, tipo_cobertura, detalle, id_eventualidad, fech_fin)
            select cve_justificante, cve_empleado, fecha, tipo, detalle, cve_eventualidad, fech_fin from old.justificantes');
        $this->db->query("select setval(pg_get_serial_sequence('justificante', 'id_justificante'), (select max(id_justificante) from justificante))");
        $this->db->query("update justificante set tipo_cobertura = (case tipo_cobertura when 'E' then 'entrada' when 'S' then 'salida' when 'D' then 'dia' when 'V' then 'vacaciones' end) ");

        $this->db->query('delete from old.justificante_periodo where cve_justificante not in (select cve_justificante from old.justificantes) ;');
        $this->db->query('truncate justificante_periodo restart identity');
        $this->db->query('insert into justificante_periodo (id_justificante_periodo, id_justificante, id_periodo_vacacional, anio)
            select id_justificante_periodo, cve_justificante, id_periodo, anio from old.justificante_periodo');
        $this->db->query("select setval(pg_get_serial_sequence('justificante_periodo', 'id_justificante_periodo'), (select max(id_justificante_periodo) from justificante_periodo))");

        $this->db->query('truncate justificante_masivo restart identity cascade');
        $this->db->query('insert into justificante_masivo (id_justificante_masivo, fecha, detalle, tipo_cobertura, fech_fin)
            select cve_justificante_masivo, fecha, desc_justificante_masivo, tipo, fech_fin from old.justificantes_masivos');
        $this->db->query("select setval(pg_get_serial_sequence('justificante_masivo', 'id_justificante_masivo'), (select max(id_justificante_masivo) from justificante_masivo))");
        $this->db->query("update justificante_masivo set tipo_cobertura = (case tipo_cobertura when 'E' then 'entrada' when 'S' then 'salida' when 'D' then 'dia' when 'V' then 'vacaciones' end) ");

        $this->db->query('delete from old.justificante_masivo_empleados where cve_justificante_masivo not in (select cve_justificante_masivo from old.justificantes_masivos)');
        $this->db->query('delete from old.justificante_masivo_empleados where cve_empleado  not in (select cve_empleado from old.empleados)');
        $this->db->query('truncate justificante_masivo_empleado restart identity');
        $this->db->query('insert into justificante_masivo_empleado (id_justificante_masivo_empleado, id_justificante_masivo, id_empleado)
            select id_justificante_masivo_empleado, cve_justificante_masivo, cve_empleado from old.justificante_masivo_empleados');
        $this->db->query("select setval(pg_get_serial_sequence('justificante_masivo_empleado', 'id_justificante_masivo_empleado'), (select max(id_justificante_masivo_empleado) from justificante_masivo_empleado))");

        $this->db->query('delete from old.justificante_masivo_periodo where cve_justificante_masivo not in (select cve_justificante_masivo from old.justificantes_masivos)');
        $this->db->query('truncate justificante_masivo_periodo restart identity');
        $this->db->query('insert into justificante_masivo_periodo (id_justificante_masivo_periodo, id_justificante_masivo, id_periodo_vacacional, anio)
            select id_justificante_masivo_periodo, cve_justificante_masivo, id_periodo, anio from old.justificante_masivo_periodo');
        $this->db->query("select setval(pg_get_serial_sequence('justificante_masivo_periodo', 'id_justificante_masivo_periodo'), (select max(id_justificante_masivo_periodo) from justificante_masivo_periodo))");

        $this->db->query('truncate dia_inhabil restart identity');
        $this->db->query('insert into dia_inhabil (id_dia_inhabil, fecha, detalle)
            select cve_dia_inhabil, fecha, desc_dia_inhabil from old.dias_inhabiles');
        $this->db->query("select setval(pg_get_serial_sequence('dia_inhabil', 'id_dia_inhabil'), (select max(id_dia_inhabil) from dia_inhabil))");

        /* registros */

    }
}
