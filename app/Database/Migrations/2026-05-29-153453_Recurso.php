<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Recurso extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_recurso' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom_recurso' => [
                'type' => 'text',
                'null' => true,
            ],
            'url' => [
                'type' => 'text',
                'null' => true,
            ],
            'archivo' => [
                'type' => 'text',
                'null' => true,
            ],
            'activo' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_recurso', true);
        $this->forge->createTable('recurso');
    }

    public function down()
    {
        $this->forge->dropTable('recurso');
    }
}
