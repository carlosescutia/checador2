<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperacionSeeder extends Seeder
{
    public function run()
    {
        /*
        operacionSeeder
        * truncar solamente para nueva operación desde cero ** Peligroso **

        --------
        truncado
        --------
        */
        $this->db->query('truncate recurso restart identity');
        $this->db->query('truncate acceso_sistema_usuario restart identity');
        $this->db->query('truncate bitacora restart identity');

        /*
        ------------------
        truncado y seeding
        ------------------
        */
        $this->db->query('truncate usuario restart identity cascade');
        $this->call('UsuarioSeeder');
    }
}
