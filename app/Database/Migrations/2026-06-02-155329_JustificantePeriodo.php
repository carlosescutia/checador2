<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JustificantePeriodo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_justificante_periodo' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_justificante' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_periodo_vacacional' => [
                'type' => 'int',
                'null' => true,
            ],
            'anio' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_justificante_periodo', true);
        $this->forge->createTable('justificante_periodo');
    }

    public function down()
    {
        $this->forge->dropTable('justificante_periodo');
    }
}
