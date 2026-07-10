<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate rol restart identity cascade');

        $data = [
            [
                'id_rol' => 'admin',
                'nom_rol' => 'Administrador',
            ],
            [
                'id_rol' => 'operador',
                'nom_rol' => 'Operador',
            ],
            [
                'id_rol' => 'empleado',
                'nom_rol' => 'Empleado',
            ],
        ];
        $this->db->table('rol')->insertBatch($data);
    }
}
