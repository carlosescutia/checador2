<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterHorarioEspecialDia extends Migration
{
    public function up()
    {
        // parámetros: id_horario_especial referencia en tabla horario_especial columna id_horario_especial, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_horario_especial', 'horario_especial', 'id_horario_especial', '', 'cascade');
        // agregar foreign key definida a tabla horario_especial_dia
        $this->forge->processIndexes('horario_especial_dia');
    }

    public function down()
    {
        $this->forge->dropForeignKey('horario_especial_dia','horario_especial_dia_id_horario_especial_foreign');
    }
}
