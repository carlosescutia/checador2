<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Asistencia extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_asistencia' => [
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
            'hora' => [
                'type' => 'time',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_asistencia', true);
        $this->forge->createTable('asistencia');
    }

    public function down()
    {
        $this->forge->dropTable('asistencia');
    }
}
