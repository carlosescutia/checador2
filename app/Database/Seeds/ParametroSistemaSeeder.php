<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ParametroSistemaSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate parametro_sistema restart identity');

        $data = [
            [
                'nom_parametro_sistema' => 'anio',
                'valor' => '2026',
            ],
            [
                'nom_parametro_sistema' => 'hora_entrada',
                'valor' => '09:00',
            ],
            [
                'nom_parametro_sistema' => 'hora_salida',
                'valor' => '17:00',
            ],
            [
                'nom_parametro_sistema' => 'dias_cargar',
                'valor' => '40',
            ],
            [
                'nom_parametro_sistema' => 'tolerancia_retardo',
                'valor' => '0:15',
            ],
            [
                'nom_parametro_sistema' => 'tolerancia_asistencia',
                'valor' => '0:30',
            ],
        ];

        $this->db->table('parametro_sistema')->insertBatch($data);
    }
}
