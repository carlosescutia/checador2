<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Justificante extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_justificante' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_empleado' => [
                'type' => 'int',
                'null' => true,
            ],
            'fecha' => [
                'type' => 'date',
                'null' => true,
            ],
            'tipo_cobertura' => [
                'type' => 'text',
                'null' => true,
            ],
            'detalle' => [
                'type' => 'text',
                'null' => true,
            ],
            'id_eventualidad' => [
                'type' => 'int',
                'null' => true,
            ],
            'fech_fin' => [
                'type' => 'date',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_justificante', true);
        $this->forge->createTable('justificante');
    }

    public function down()
    {
        $this->forge->dropTable('justificante');
    }
}
