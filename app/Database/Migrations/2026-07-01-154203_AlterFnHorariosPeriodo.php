<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterFnHorariosPeriodo extends Migration
{
    public function up()
    {
        $sql = ""
            ."/* "
            ."Función horarios_periodo(fech_ini, fech_fin) "
            ."----------------------- "
            ."Obtiene horarios (entrada y salida) por empleado entre dos fechas "
            ."toma en cuenta horarios especiales "
            ."*/ "
            ."create or replace function horarios_periodo(fech_ini date, fech_fin date) "
            ."returns table(id_empleado int, fecha date, hora_entrada time, hora_salida time) as "
            ."$$ "
            ."begin "
                ."return query "
                ."select "
                    ."e.id_empleado, dh.fecha, "
                    ."coalesce(hd.hora_entrada, (select valor::time from parametro_sistema where nom_parametro_sistema = 'hora_entrada')) as hora_entrada, "
                    ."coalesce(hd.hora_salida, (select valor::time from parametro_sistema where nom_parametro_sistema = 'hora_salida')) as hora_salida "
                ."from "
                    ."dias_habiles_periodo(fech_ini, fech_fin) dh "
                    ."cross join empleado e "
                    ."left join horario h on h.id_empleado = e.id_empleado and dh.fecha::timestamp between h.fech_ini and h.fech_fin "
                    ."left join horario_dia hd on hd.id_horario = h.id_horario and hd.id_dia = extract(dow from dh.fecha::timestamp) "
                ."where "
                    ."e.activo = 1 "
                ."order by "
                    ."dh.fecha "
                ."; "
            ."end; "
            ."$$ language plpgsql strict immutable; "
            ."";
        $query = $this->db->query($sql);
    }

    public function down()
    {
        $sql = ""
            ."/* "
            ."Función horarios_periodo(fech_ini, fech_fin) "
            ."----------------------- "
            ."Obtiene horarios (entrada y salida) por empleado entre dos fechas "
            ."toma en cuenta horarios especiales "
            ."*/ "
            ."create or replace function horarios_periodo(fech_ini date, fech_fin date) "
            ."returns table(id_empleado int, fecha date, hora_entrada time, hora_salida time) as "
            ."$$ "
            ."begin "
                ."return query "
                ."select "
                    ."distinct e.id_empleado, dh.fecha, "
                    ."coalesce(hsp.hora_entrada, hb.hora_entrada) as hora_entrada, "
                    ."coalesce(hsp.hora_salida, hb.hora_salida) as hora_salida "
                ."from "
                    ."dias_habiles_periodo(fech_ini, fech_fin) dh "
                    ."cross join empleado e "
                    ."left join horario_especial he on he.id_empleado = e.id_empleado and dh.fecha::timestamp between he.fech_ini and he.fech_fin "
                    ."left join horario_especial_dia hed on hed.id_horario_especial = he.id_horario_especial and hed.id_dia = extract(dow from dh.fecha::timestamp) "
                    ."left join horario hsp on hsp.id_horario = hed.id_horario "
                    ."left join horario hb on hb.id_horario = e.id_horario "
                ."where "
                    ."e.activo = 1 "
                ."order by "
                    ."dh.fecha "
                ."; "
            ."end; "
            ."$$ language plpgsql strict immutable; "
            ."";
        $query = $this->db->query($sql);
    }
}
