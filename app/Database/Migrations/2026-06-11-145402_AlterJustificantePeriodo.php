<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterJustificantePeriodo extends Migration
{
    public function up()
    {
        // parámetros: id_justificante referencia en tabla justificante columna id_justificante, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_justificante', 'justificante', 'id_justificante', '', 'cascade');
        // agregar foreign key definida a tabla justificante_periodo
        $this->forge->processIndexes('justificante_periodo');
    }

    public function down()
    {
        $this->forge->dropForeignKey('justificante_periodo','justificante_periodo_id_justificante_foreign');
    }
}
