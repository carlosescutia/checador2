<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoIncidente extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tipo_incidente' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cve_tipo_incidente' => [
                'type' => 'text',
                'null' => true,
            ],
            'nom_tipo_incidente' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_tipo_incidente', true);
        $this->forge->createTable('tipo_incidente');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_incidente');
    }
}
