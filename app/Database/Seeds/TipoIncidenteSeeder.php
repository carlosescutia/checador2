<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoIncidenteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cve_tipo_incidente' => 'retardo_salida_temprano',
                'nom_tipo_incidente' => 'Retardo, salida temprano',
            ],
            [
                'cve_tipo_incidente' => 'retardo',
                'nom_tipo_incidente' => 'Retardo',
            ],
            [
                'cve_tipo_incidente' => 'entrada_tardia_salida_temprano',
                'nom_tipo_incidente' => 'Entrada tardía, salida temprano',
            ],
            [
                'cve_tipo_incidente' => 'entrada_tardia',
                'nom_tipo_incidente' => 'Entrada tardía',
            ],
            [
                'cve_tipo_incidente' => 'salida_temprano',
                'nom_tipo_incidente' => 'Salida temprano',
            ],
            [
                'cve_tipo_incidente' => 'sin_entrada_salida_temprano',
                'nom_tipo_incidente' => 'Sin entrada, salida temprano',
            ],
            [
                'cve_tipo_incidente' => 'sin_entrada',
                'nom_tipo_incidente' => 'Sin entrada',
            ],
            [
                'cve_tipo_incidente' => 'retardo_sin_salida',
                'nom_tipo_incidente' => 'Retardo, sin salida',
            ],
            [
                'cve_tipo_incidente' => 'entrada_tardia_sin_salida',
                'nom_tipo_incidente' => 'Entrada tardía, sin salida',
            ],
            [
                'cve_tipo_incidente' => 'sin_salida',
                'nom_tipo_incidente' => 'Sin salida',
            ],
            [
                'cve_tipo_incidente' => 'inasistencia',
                'nom_tipo_incidente' => 'Inasistencia',
            ],
        ];

        $this->db->table('tipo_incidente')->insertBatch($data);
    }
}
