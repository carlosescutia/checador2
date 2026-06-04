<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FnDiasHabilesPeriodo extends Migration
{
    public function up()
    {
        $sql = ""
            ."/* "
            ."Función dias_habiles_periodo(fech_ini, fech_fin) "
            ."----------------------- "
            ."Genera tabla con los dias habiles entre dos fechas "
            ."excluyendo fines de semana "
            ."*/ "
            ."create or replace function dias_habiles_periodo(fech_ini date, fech_fin date) "
            ."returns table (fecha date) as "
            ."$$ "
            ."begin "
                ."return query "
                ."select "
                    ."dt::date "
                ."from "
                    ."generate_series(fech_ini, fech_fin, interval '1' day) as t(dt) "
                ."where "
                    ."extract(dow from dt) between 1 and 5 "
                ."; "
            ."end; "
            ."$$ language plpgsql strict immutable; "
            ."";
        $query = $this->db->query($sql);
    }

    public function down()
    {
        $sql = "drop function if exists dias_habiles_periodo(date, date) ";
        $query = $this->db->query($sql);
    }
}
