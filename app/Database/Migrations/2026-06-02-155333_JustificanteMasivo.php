<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JustificanteMasivo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_justificante_masivo' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fecha' => [
                'type' => 'date',
                'null' => true,
            ],
            'detalle' => [
                'type' => 'text',
                'null' => true,
            ],
            'tipo_cobertura' => [
                'type' => 'text',
                'null' => true,
            ],
            'fech_fin' => [
                'type' => 'date',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_justificante_masivo', true);
        $this->forge->createTable('justificante_masivo');
    }

    public function down()
    {
        $this->forge->dropTable('justificante_masivo');
    }
}
