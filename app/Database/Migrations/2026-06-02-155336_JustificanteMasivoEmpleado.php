<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JustificanteMasivoEmpleado extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_justificante_masivo_empleado' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_justificante_masivo' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_empleado' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_justificante_masivo_empleado', true);
        $this->forge->createTable('justificante_masivo_empleado');
    }

    public function down()
    {
        $this->forge->dropTable('justificante_masivo_empleado');
    }
}
