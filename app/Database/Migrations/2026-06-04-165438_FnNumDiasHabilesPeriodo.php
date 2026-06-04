<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FnNumDiasHabilesPeriodo extends Migration
{
    public function up()
    {
        $sql = ""
            ."/* "
            ."Función num_dias_habiles_periodo(fech_ini, fech_fin) "
            ."----------------------- "
            ."Devuelve el número de días hábiles entre dos fechas "
            ."excluyendo fines de semana y dias registrados en tabla dia_inhabil "
            ."*/ "
            ."create or replace function num_dias_habiles_periodo(fech_ini date, fech_fin date) "
            ."returns integer as "
            ."$$ "
            ."begin "
                ."return ( "
                    ."select "
                        ."count(*) "
                    ."from "
                        ."generate_series(fech_ini, fech_fin, interval '1' day) as t(dt) "
                    ."where "
                        ."extract(dow from dt) between 1 and 5 "
                        ."and dt not in (select fecha from dia_inhabil) "
                .") ; "
            ."end; "
            ."$$ language plpgsql strict immutable; "
            ."";
        $query = $this->db->query($sql);
    }

    public function down()
    {
        $sql = "drop function if exists num_dias_habiles_periodo(date, date) ";
        $query = $this->db->query($sql);
    }
}
