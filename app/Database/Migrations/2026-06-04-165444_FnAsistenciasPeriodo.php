<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FnAsistenciasPeriodo extends Migration
{
    public function up()
    {
        $sql = ""
            ."/* "
            ."Función asistencias_periodo(fech_ini, fech_fin) "
            ."----------------------- "
            ."Obtiene asistencias (entrada y salida) por empleado entre dos fechas "
            ."*/ "
            ."create or replace function asistencias_periodo(fech_ini date, fech_fin date) "
            ."returns table(id_empleado int, fecha date, hora_entrada time, hora_salida time) as "
            ."$$ "
            ."begin "
                ."return query "
                ."select "
                    ."distinct e.id_empleado, dh.fecha, min(a.hora) as hora_entrada, max(a.hora) as hora_salida "
                ."from "
                    ."dias_habiles_periodo(fech_ini, fech_fin) dh "
                    ."cross join empleado e "
                    ."left join asistencia a on dh.fecha = a.fecha and e.id_empleado = a.id_empleado "
                ."where "
                    ."e.activo = 1 "
                ."group by "
                    ."e.id_empleado, dh.fecha "
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
        $sql = "drop function if exists asistencias_periodo(date, date) ";
        $query = $this->db->query($sql);
    }
}
