<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoCoberturaSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate tipo_cobertura restart identity cascade');

        $data = [
            [
                'cve_tipo_cobertura' => 'dia',
                'nom_tipo_cobertura' => 'Día',
            ],
            [
                'cve_tipo_cobertura' => 'entrada',
                'nom_tipo_cobertura' => 'Entrada',
            ],
            [
                'cve_tipo_cobertura' => 'salida',
                'nom_tipo_cobertura' => 'Salida',
            ],
            [
                'cve_tipo_cobertura' => 'vacaciones',
                'nom_tipo_cobertura' => 'Vacaciones',
            ],
        ];
        $this->db->table('tipo_cobertura')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('tipo_cobertura', 'id_tipo_cobertura'), (select max(id_tipo_cobertura) from tipo_cobertura))");
    }
}
