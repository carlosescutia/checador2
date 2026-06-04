<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoJustificante extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tipo_justificante' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cve_tipo_justificante' => [
                'type' => 'text',
                'null' => true,
            ],
            'nom_tipo_justificante' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_tipo_justificante', true);
        $this->forge->createTable('tipo_justificante');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_justificante');
    }
}
