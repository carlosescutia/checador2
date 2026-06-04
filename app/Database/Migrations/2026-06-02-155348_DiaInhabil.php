<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DiaInhabil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dia_inhabil' => [
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
        ]);
        $this->forge->addKey('id_dia_inhabil', true);
        $this->forge->createTable('dia_inhabil');
    }

    public function down()
    {
        $this->forge->dropTable('dia_inhabil');
    }
}
