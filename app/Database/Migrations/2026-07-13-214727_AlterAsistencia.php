<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAsistencia extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('asistencia',[
            'id_empleado' => [
                'name' => 'cod_empleado',
                'type' => 'int',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('asistencia',[
            'cod_empleado' => [
                'name' => 'id_empleado',
                'type' => 'int',
                'null' => true,
            ],
        ]);
    }
}
