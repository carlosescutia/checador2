<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JustificanteMasivoPeriodo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_justificante_masivo_periodo' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_justificante_masivo' => [
                'type' => 'int',
                'null' => true,
            ],
            'id_periodo' => [
                'type' => 'int',
                'null' => true,
            ],
            'anio' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_justificante_masivo_periodo', true);
        $this->forge->createTable('justificante_masivo_periodo');
    }

    public function down()
    {
        $this->forge->dropTable('justificante_masivo_periodo');
    }
}
