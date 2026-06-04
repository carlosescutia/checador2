<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoCobertura extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tipo_cobertura' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cve_tipo_cobertura' => [
                'type' => 'text',
                'null' => true,
            ],
            'nom_tipo_cobertura' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_tipo_cobertura', true);
        $this->forge->createTable('tipo_cobertura');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_cobertura');
    }
}
