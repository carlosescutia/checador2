<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::index', ['filter' => ['auth',]] );
$routes->get('login', 'Admin::login');
$routes->post('post_login', 'Admin::post_login');
$routes->get('logout', 'Admin::logout');

$routes->get('catalogos/', 'Catalogos::index', ['filter' => ['auth', 'perms_and:catalogo.can_view']] );

$routes->get('usuario/', 'Usuario::index', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->get('usuario/detalle/(:num)', 'Usuario::detalle/$1', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->get('usuario/nuevo', 'Usuario::nuevo', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->post('usuario/guardar', 'Usuario::guardar', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->post('usuario/guardar_activo', 'Usuario::guardar_activo', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->post('usuario/eliminar', 'Usuario::eliminar', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );

$routes->post('usuario/generar_token_cambio_pwd', 'Usuario::generar_token_cambio_pwd', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->post('usuario/eliminar_token_cambio_pwd', 'Usuario::eliminar_token_cambio_pwd', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->get('usuario/nuevo_pwd/(:segment)', 'Usuario::nuevo_pwd/$1');
$routes->post('usuario/actualizar_password', 'Usuario::actualizar_password', ['filter' => ['auth', 'perms_and:usuario.can_edit']] );
$routes->get('usuario/existe/(:segment)', 'Usuario::existe/$1');


$routes->get('rol/', 'Rol::index', ['filter' => ['auth', 'perms_and:rol.can_view']] );

$routes->get('opcion_sistema/', 'Opcion_sistema::index', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );
$routes->get('opcion_sistema/detalle/(:num)', 'Opcion_sistema::detalle/$1', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );
$routes->get('opcion_sistema/nuevo', 'Opcion_sistema::nuevo', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );
$routes->post('opcion_sistema/guardar', 'Opcion_sistema::guardar', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );
$routes->post('opcion_sistema/guardar_otorgable', 'Opcion_sistema::guardar_otorgable', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );
$routes->post('opcion_sistema/eliminar', 'Opcion_sistema::eliminar', ['filter' => ['auth', 'perms_and:opcion_sistema.can_edit']] );

$routes->get('acceso_sistema/', 'Acceso_sistema::index', ['filter' => ['auth', 'perms_and:acceso_sistema.can_edit']] );
$routes->get('acceso_sistema/nuevo', 'Acceso_sistema::nuevo', ['filter' => ['auth', 'perms_and:acceso_sistema.can_edit']] );
$routes->post('acceso_sistema/guardar', 'Acceso_sistema::guardar', ['filter' => ['auth', 'perms_and:acceso_sistema.can_edit']] );
$routes->post('acceso_sistema/eliminar', 'Acceso_sistema::eliminar', ['filter' => ['auth', 'perms_and:acceso_sistema.can_edit']] );

$routes->get('parametro_sistema/', 'Parametro_sistema::index', ['filter' => ['auth', 'perms_and:parametro_sistema.can_edit']] );
$routes->get('parametro_sistema/detalle/(:num)', 'Parametro_sistema::detalle/$1', ['filter' => ['auth', 'perms_and:parametro_sistema.can_edit']] );
$routes->get('parametro_sistema/nuevo', 'Parametro_sistema::nuevo', ['filter' => ['auth', 'perms_and:parametro_sistema.can_edit']] );
$routes->post('parametro_sistema/guardar', 'Parametro_sistema::guardar', ['filter' => ['auth', 'perms_and:parametro_sistema.can_edit']] );
$routes->post('parametro_sistema/eliminar', 'Parametro_sistema::eliminar', ['filter' => ['auth', 'perms_and:parametro_sistema.can_edit']] );

$routes->post('acceso_sistema_usuario/guardar', 'Acceso_sistema_usuario::guardar', ['filter' => ['auth', 'perms_and:acceso_sistema_usuario.can_edit']] );
$routes->post('acceso_sistema_usuario/eliminar', 'Acceso_sistema_usuario::eliminar', ['filter' => ['auth', 'perms_and:acceso_sistema_usuario.can_edit']] );

$routes->post('archivo/subir', 'Archivo::subir', ['filter' => ['auth', 'perms_and:archivo.can_upload']] );
$routes->post('archivo/eliminar', 'Archivo::eliminar', ['filter' => ['auth', 'perms_and:archivo.can_delete']] );
$routes->post('archivo/subir_recurso', 'Archivo::subir_recurso', ['filter' => ['auth', 'perms_and:recurso.can_edit,archivo.can_upload']] );
$routes->post('archivo/eliminar_recurso', 'Archivo::eliminar_recurso', ['filter' => ['auth', 'perms_and:recurso.can_edit,archivo.can_delete']] );

$routes->get('recurso/', 'Recurso::index', ['filter' => ['auth', 'perms_and:recurso.can_edit']] );
$routes->get('recurso/detalle/(:num)', 'Recurso::detalle/$1', ['filter' => ['auth', 'perms_and:recurso.can_edit']] );
$routes->get('recurso/nuevo', 'Recurso::nuevo', ['filter' => ['auth', 'perms_and:recurso.can_edit']] );
$routes->post('recurso/guardar', 'Recurso::guardar', ['filter' => ['auth', 'perms_and:recurso.can_edit']] );
$routes->post('recurso/eliminar', 'Recurso::eliminar', ['filter' => ['auth', 'perms_and:recurso.can_edit']] );

$routes->get('proceso/', 'Proceso::index');

$routes->get('reportes/', 'Reportes::index', ['filter' => ['auth', 'perms_and:reporte.can_view']] );
$routes->get('reportes/bitacora', 'Reportes::bitacora', ['filter' => ['auth', 'perms_or:reporte_admin.can_view,reporte_mentor.can_view,reporte_alumno.can_view']] );
$routes->get('reportes/bitacora/(:segment)', 'Reportes::bitacora/$1', ['filter' => ['auth', 'perms_or:reporte_admin.can_view,reporte_mentor.can_view,reporte_alumno.can_view']] );
