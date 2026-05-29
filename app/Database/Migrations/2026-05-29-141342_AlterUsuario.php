<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsuario extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuario',[
            'token_cambio_pwd' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuario',[
            'token_cambio_pwd',
        ]);
    }
}
