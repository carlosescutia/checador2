<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeriodoVacacional extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_periodo_vacacional' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom_periodo_vacacional' => [
                'type' => 'text',
                'null' => true,
            ],
            'orden' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_periodo_vacacional', true);
        $this->forge->createTable('periodo_vacacional');
    }

    public function down()
    {
        $this->forge->dropTable('periodo_vacacional');
    }
}
