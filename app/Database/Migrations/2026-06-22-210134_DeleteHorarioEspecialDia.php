<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteHorarioEspecialDia extends Migration
{
    public function up()
    {
        $this->forge->dropTable('horario_especial_dia');
    }

    public function down()
    {
        $this->forge->addField([
            'id_horario_especial_dia' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_horario_especial' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_dia' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_horario' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_horario_especial_dia', true);
        $this->forge->createTable('horario_especial_dia');
    }
}
