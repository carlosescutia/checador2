<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddUsuarios extends Seeder
{
    public function run()
    {
        $this->db->query("insert into usuario (id_rol, nom_usuario, nom_login, activo)
            select 'empleado', nom_empleado, correo, activo from empleado e where coalesce(e.id_usuario, 0) not in (select id_usuario from usuario )" );


        $this->db->query('update empleado e set id_usuario = (select id_usuario from usuario where nom_usuario = e.nom_empleado) ');
    }
}
