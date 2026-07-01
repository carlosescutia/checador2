<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmpleado extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('empleado',[
            'id_horario',
        ]);
    }

    public function down()
    {
        $this->forge->addColumn('empleado',[
            'id_horario' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);
    }
}
