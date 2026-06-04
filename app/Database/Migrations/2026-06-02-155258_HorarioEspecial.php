<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HorarioEspecial extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_horario_especial' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_empleado' => [
                'type' => 'int',
                'null' => true,
            ],
            'nom_horario_especial' => [
                'type' => 'text',
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
        $this->forge->addKey('id_horario_especial', true);
        $this->forge->createTable('horario_especial');
    }

    public function down()
    {
        $this->forge->dropTable('horario_especial');
    }
}
