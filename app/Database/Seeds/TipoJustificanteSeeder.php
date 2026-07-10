<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoJustificanteSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate tipo_justificante restart identity cascade');

        $data = [
            [
                'cve_tipo_justificante' => 'dia_inhabil',
                'nom_tipo_justificante' => 'Día inhábil',
            ],
            [
                'cve_tipo_justificante' => 'j_mas_completo_general',
                'nom_tipo_justificante' => 'Justificante masivo tipo Día o Vacación sin especificar empleados a aplicar (aplica a todos)',
            ],
            [
                'cve_tipo_justificante' => 'j_mas_completo_especifico',
                'nom_tipo_justificante' => 'Justificante masivo tipo Día o Vacación especificando empleados a aplicar',
            ],
            [
                'cve_tipo_justificante' => 'j_ind_completo',
                'nom_tipo_justificante' => 'Justificante individual tipo Día o Vacación',
            ],
            [
                'cve_tipo_justificante' => 'j_mas_parcial_general',
                'nom_tipo_justificante' => 'Justificante masivo tipo Entrada o Salida sin especificar empleados a aplicar (aplica a todos)',
            ],
            [
                'cve_tipo_justificante' => 'j_mas_parcial_especifico',
                'nom_tipo_justificante' => 'Justificante masivo tipo Entrada o salida especificando empleados a aplicar',
            ],
            [
                'cve_tipo_justificante' => 'j_ind_parcial',
                'nom_tipo_justificante' => 'Justificante individual tipo Entrada o Salida',
            ],
            [
                'cve_tipo_justificante' => 'cumple_horas',
                'nom_tipo_justificante' => 'Cumple horas de trabajo',
            ],
        ];
        $this->db->table('tipo_justificante')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('tipo_justificante', 'id_tipo_justificante'), (select max(id_tipo_justificante) from tipo_justificante))");
    }
}
