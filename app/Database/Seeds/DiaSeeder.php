<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiaSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate dia restart identity cascade');

        $data = [
            [
                'id_dia' => '1',
                'nom_dia' => 'Lunes',
            ],
            [
                'id_dia' => '2',
                'nom_dia' => 'Martes',
            ],
            [
                'id_dia' => '3',
                'nom_dia' => 'Miércoles',
            ],
            [
                'id_dia' => '4',
                'nom_dia' => 'Jueves',
            ],
            [
                'id_dia' => '5',
                'nom_dia' => 'Viernes',
            ],
            [
                'id_dia' => '6',
                'nom_dia' => 'Sábado',
            ],
            [
                'id_dia' => '7',
                'nom_dia' => 'Domingo',
            ],
        ];
        $this->db->table('dia')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('dia', 'id_dia'), (select max(id_dia) from dia))");
    }
}
