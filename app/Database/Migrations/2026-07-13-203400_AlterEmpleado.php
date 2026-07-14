<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmpleado extends Migration
{
    public function up()
    {
        $this->forge->addColumn('empleado',[
            'correo' => [
                'type' => 'text',
                'null' => true,
            ],
            'id_usuario' => [
                'type' => 'int',
                'null' => true,
            ],
            'cod_empleado_tmp' => [
                'type' => 'int',
                'null' => true,
            ],
        ]);

        $this->db->query('update empleado set cod_empleado_tmp = cod_empleado::int');

        $this->forge->dropColumn('empleado',[
            'cod_empleado',
        ]);

        $this->forge->modifyColumn('empleado',[
            'cod_empleado_tmp' => [
                'name' => 'cod_empleado',
                'type' => 'int',
                'null' => true,
            ],
        ]);


    }

    public function down()
    {
        $this->forge->dropColumn('empleado',[
            'correo',
            'id_usuario',
        ]);

        $this->forge->modifyColumn('empleado',[
            'cod_empleado' => [
                'type' => 'text',
                'null' => true,
            ],
        ]);

    }
}
