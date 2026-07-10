<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OpcionSistemaSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('truncate opcion_sistema restart identity cascade');

        $data = [
            [
                'cod_opcion_sistema' => 'reporte.can_view',
                'nom_opcion_sistema' => 'Ver reportes',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'reporte_empleado.can_view',
                'nom_opcion_sistema' => 'Reportes de empleado',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'reporte_operador.can_view',
                'nom_opcion_sistema' => 'Reportes de operador',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'reporte_admin.can_view',
                'nom_opcion_sistema' => 'Reportes de administrador',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'catalogo.can_view',
                'nom_opcion_sistema' => 'Ver catalogos',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'parametro_sistema.can_edit',
                'nom_opcion_sistema' => 'Editar parámetros del sistema',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'opcion_sistema.can_edit',
                'nom_opcion_sistema' => 'Editar opciones del sistema',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'acceso_sistema.can_edit',
                'nom_opcion_sistema' => 'Editar accesos del sistema',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'acceso_sistema_usuario.can_edit',
                'nom_opcion_sistema' => 'Editar accesos del sistema por usuario',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'usuario.can_edit',
                'nom_opcion_sistema' => 'Editar usuarios',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'rol.can_view',
                'nom_opcion_sistema' => 'Ver roles',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'recurso.can_edit',
                'nom_opcion_sistema' => 'Editar recursos',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'archivo.can_upload',
                'nom_opcion_sistema' => 'Subir archivos',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'archivo.can_delete',
                'nom_opcion_sistema' => 'Eliminar archivos',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'empleado.can_edit',
                'nom_opcion_sistema' => 'Editar empleados',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'horario.can_edit',
                'nom_opcion_sistema' => 'Editar horarios',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'periodo_vacacional.can_edit',
                'nom_opcion_sistema' => 'Editar periodos vacacionales',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'eventualidad.can_edit',
                'nom_opcion_sistema' => 'Editar eventualidades',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'tipo_cobertura.can_edit',
                'nom_opcion_sistema' => 'Editar periodos vacacionales',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'tipo_incidente.can_edit',
                'nom_opcion_sistema' => 'Editar periodos vacacionales',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'tipo_justificante.can_edit',
                'nom_opcion_sistema' => 'Editar periodos vacacionales',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'importar.can_edit',
                'nom_opcion_sistema' => 'Importar del checador',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'dia_inhabil.can_edit',
                'nom_opcion_sistema' => 'Editar dias inhábiles',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'justificante.can_edit',
                'nom_opcion_sistema' => 'Editar justificantes',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'justificante_masivo.can_edit',
                'nom_opcion_sistema' => 'Editar justificantes masivos',
                'otorgable' => null
            ],
        ];
        $this->db->table('opcion_sistema')->insertBatch($data);

        $this->db->query("select setval(pg_get_serial_sequence('opcion_sistema', 'id_opcion_sistema'), (select max(id_opcion_sistema) from opcion_sistema))");
    }
}
