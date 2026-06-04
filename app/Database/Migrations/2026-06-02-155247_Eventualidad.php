<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Eventualidad extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_eventualidad' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom_eventualidad' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_eventualidad', true);
        $this->forge->createTable('eventualidad');
    }

    public function down()
    {
        $this->forge->dropTable('eventualidad');
    }
}
