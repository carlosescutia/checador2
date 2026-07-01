<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dia extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dia' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom_dia' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_dia', true);
        $this->forge->createTable('dia');
    }

    public function down()
    {
        $this->forge->dropTable('dia');
    }
}
