<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterJustificanteMasivoEmpleado extends Migration
{
    public function up()
    {
        // parámetros: id_justificante_masivo referencia en tabla justificante_masivo columna id_justificante_masivo, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_justificante_masivo', 'justificante_masivo', 'id_justificante_masivo', '', 'cascade');

        // parámetros: id_empleado referencia en tabla empleado columna id_empleado, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_empleado', 'empleado', 'id_empleado', '', 'cascade');

        // agregar foreign key definida a tabla justificante_masivo_empleado
        $this->forge->processIndexes('justificante_masivo_empleado');
    }

    public function down()
    {
        $this->forge->dropForeignKey('justificante_masivo_empleado','justificante_masivo_empleado_id_empleado_foreign');
        $this->forge->dropForeignKey('justificante_masivo_empleado','justificante_masivo_empleado_id_justificante_masivo_foreign');
    }
}
