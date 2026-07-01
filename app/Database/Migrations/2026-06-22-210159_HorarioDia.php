<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HorarioDia extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_horario_dia' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_horario' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_dia' => [
                'type' => 'int',
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
        $this->forge->addKey('id_horario_dia', true);
        // parámetros: id_horario referencia en tabla horario columna id_horario, on update do nothing, on delete cascade
        $this->forge->addForeignKey('id_horario', 'horario', 'id_horario', '', 'cascade');
        $this->forge->createTable('horario_dia');
    }

    public function down()
    {
        $this->forge->dropTable('horario_dia');
    }
}
