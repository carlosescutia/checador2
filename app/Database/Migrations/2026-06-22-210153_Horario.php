<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Horario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_horario' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_empleado' => [
                'type' => 'int',
                'null' => true,
            ],
            'fech_ini' => [
                'type' => 'date',
                'null' => true,
            ],
            'fech_fin' => [
                'type' => 'date',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_horario', true);
        // parámetros: id_empleado referencia en tabla empleado columna id_empleado, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_empleado', 'empleado', 'id_empleado', '', 'cascade');
        $this->forge->createTable('horario');
    }

    public function down()
    {
        $this->forge->dropTable('horario');
    }
}
