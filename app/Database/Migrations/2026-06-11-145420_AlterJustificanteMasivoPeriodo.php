<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterJustificanteMasivoPeriodo extends Migration
{
    public function up()
    {
        // parámetros: id_justificante_masivo referencia en tabla justificante_masivo columna id_justificante_masivo, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_justificante_masivo', 'justificante_masivo', 'id_justificante_masivo', '', 'cascade');
        // agregar foreign key definida a tabla justificante_masivo_periodo
        $this->forge->processIndexes('justificante_masivo_periodo');
    }

    public function down()
    {
        $this->forge->dropForeignKey('justificante_masivo_periodo','justificante_masivo_periodo_id_justificante_masivo_foreign');
    }
}
