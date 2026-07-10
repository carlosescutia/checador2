<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AccesoSistemaSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate acceso_sistema restart identity cascade');

        $data = [
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'reporte.can_view',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'reporte_admin.can_view',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'catalogo.can_view',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'opcion_sistema.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'acceso_sistema.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'acceso_sistema_usuario.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'usuario.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'rol.can_view',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'opcion_sistema.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'parametro_sistema.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'recurso.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'archivo.can_upload',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'archivo.can_delete',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'empleado.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'horario.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'periodo_vacacional.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'eventualidad.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'tipo_cobertura.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'tipo_incidente.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'tipo_justificante.can_edit',
            ],
            [
                'id_rol' => 'admin',
                'cod_opcion_sistema' => 'importar.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'importar.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'reporte.can_view',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'reporte_operador.can_view',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'catalogo.can_view',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'empleado.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'horario.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'eventualidad.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'periodo_vacacional.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'parametro_sistema.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'dia_inhabil.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'justificante.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'justificante_masivo.can_edit',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'archivo.can_upload',
            ],
            [
                'id_rol' => 'operador',
                'cod_opcion_sistema' => 'archivo.can_delete',
            ],
            [
                'id_rol' => 'empleado',
                'cod_opcion_sistema' => 'reporte.can_view',
            ],
            [
                'id_rol' => 'empleado',
                'cod_opcion_sistema' => 'reporte_empleado.can_view',
            ],
        ];
        $this->db->table('acceso_sistema')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('acceso_sistema', 'id_acceso_sistema'), (select max(id_acceso_sistema) from acceso_sistema))");
    }
}
