<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteHorario extends Migration
{
    public function up()
    {
        $this->forge->dropTable('horario');
    }

    public function down()
    {
        $this->forge->addField([
            'id_horario' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom_horario' => [
                'type' => 'text',
                'null' => true,
            ],
            'hora_entrada' => [
                'type' => 'time',
                'null' => true,
            ],
            'hora_salida' => [
                'type' => 'time',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_horario', true);
        $this->forge->createTable('horario');
    }
}
