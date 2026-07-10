<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate usuario restart identity cascade');

        $data = [
            [
                'id_rol' => 'admin',
                'nom_usuario' => 'Administrador',
                'nom_login' => 'admon',
                'password' => 'hola',
                'activo' => 1
            ],
            [
                'id_rol' => 'operador',
                'nom_usuario' => 'Operador',
                'nom_login' => 'operador',
                'password' => 'hola',
                'activo' => 1
            ],
            [
                'id_rol' => 'empleado',
                'nom_usuario' => 'Empleado',
                'nom_login' => 'empleado',
                'password' => 'hola',
                'activo' => 1
            ],
        ];
        $this->db->table('usuario')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('usuario', 'id_usuario'), (select max(id_usuario) from usuario))");
    }
}
