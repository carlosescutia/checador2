<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empleado extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_empleado' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cod_empleado' => [
                'type' => 'text',
                'null' => true,
            ],
            'nom_empleado' => [
                'type' => 'text',
                'null' => true,
            ],
            'activo' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_horario' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_empleado', true);
        $this->forge->createTable('empleado');
    }

    public function down()
    {
        $this->forge->dropTable('empleado');
    }
}
