<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OpcionSistemaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cod_opcion_sistema' => 'reporte.can_view',
                'nom_opcion_sistema' => 'Ver reportes',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'reporte_alumno.can_view',
                'nom_opcion_sistema' => 'Reportes de alumno',
                'otorgable' => null
            ],
            [
                'cod_opcion_sistema' => 'reporte_mentor.can_view',
                'nom_opcion_sistema' => 'Reportes de mentor',
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
        ];

        $this->db->table('opcion_sistema')->insertBatch($data);
    }
}
