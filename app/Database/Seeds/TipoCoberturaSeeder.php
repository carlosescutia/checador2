<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoCoberturaSeeder extends Seeder
{
    public function run()
    {
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
    }
}
