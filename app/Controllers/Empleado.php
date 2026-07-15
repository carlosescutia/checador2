<?php

namespace App\Controllers;

use SimpleSoftwareIO\QrCode\Generator;

class Empleado extends BaseController
{
    public function __construct()
    {
        $this->empleado_model = model('Empleado_model');
        $this->horario_model = model('Horario_model');
        $this->horario_dia_model = model('Horario_dia_model');
        $this->usuario_model = model('Usuario_model');
    }

    public function index()
    {
        $filtro = $this->request->getGet();
        $estado = 'activos';
        if (array_key_exists('estado', $filtro)) {
            $estado = $filtro['estado'];
        }
        $data['empleados'] = $this->empleado_model->get_empleados($estado);
        $data['estado'] = $estado;

        return view('templates/header')
            .view('catalogos/empleado/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_empleado)
    {
        $qrcode = new Generator;

        $empleado = $this->empleado_model->get_empleado($id_empleado);
        $id_usuario = $empleado['id_usuario'];
        $usuario = $this->usuario_model->get_usuario($id_usuario);
        if ( empty($usuario) ) {
            $this->crear_usuario($empleado);

            $empleado = $this->empleado_model->get_empleado($id_empleado);
            $id_usuario = $empleado['id_usuario'];
            $usuario = $this->usuario_model->get_usuario($id_usuario);
        }

        $data['empleado'] = $empleado;
        $data['usuario'] = $usuario;
        $data['horarios_activos'] = $this->horario_model->get_horarios_activos_empleado($id_empleado);
        $data['horarios_inactivos'] = $this->horario_model->get_horarios_inactivos_empleado($id_empleado);
        $horarios_dias_tmp = $this->horario_dia_model->get_horarios_dias_empleado($id_empleado);
        $data['horarios_dias'] = array_group_by($horarios_dias_tmp, ['id_horario']);
        if ($data['usuario']) {
            if (array_key_exists('token_cambio_pwd', $data['usuario'])) {
                $data['qr'] = $qrcode->size(450)->format('png')->generate(site_url('usuario/nuevo_pwd/' . $data['usuario']['token_cambio_pwd']));
            } else {
                $data['qr'] = null;
            }
        }

        return view('templates/header')
            .view('catalogos/empleado/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/empleado/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $empleado = $this->request->getPost();
        if ($empleado) {

            // tabla Usuario
            $data = [];
            if (array_key_exists('id_usuario', $empleado)) {
                $data += array(
                    'id_usuario' => $empleado['id_usuario'],
                );
            }

            $data += array(
                'id_rol' => 'empleado',
                'nom_usuario' => $empleado['nom_empleado'],
                'nom_login' => $empleado['correo'],
                'activo' => array_key_exists('activo', $empleado) ? 1 : 0,
            );
            // guardar
            $this->usuario_model->save($data);
            if (array_key_exists('id_usuario', $empleado)) {
                $id_usuario = $empleado['id_usuario'];
            } else {
                $id_usuario = $this->usuario_model->getInsertID();
            }

            // tabla Empleado
            $data = [];
            if (array_key_exists('id_empleado', $empleado)) {
                $data += array(
                    'id_empleado' => $empleado['id_empleado'],
                );
            }

            $data += array(
                'nom_empleado' => $empleado['nom_empleado'],
                'cod_empleado' => $empleado['cod_empleado'],
                'correo' => $empleado['correo'],
                'id_usuario' => $id_usuario,
                'activo' => array_key_exists('activo', $empleado) ? 1 : 0,
            );
            // guardar
            $this->empleado_model->save($data);

            if (array_key_exists('id_empleado', $empleado)) {
                $accion = 'modificó';
                $id_empleado = $empleado['id_empleado'];
            } else {
                $accion = 'agregó';
                $id_empleado = $this->empleado_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'empleado';
            $valor = $id_empleado . " " .$empleado['nom_empleado'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('empleado'));
    }

    public function crear_usuario($empleado)
    {
        if ($empleado) {

            // tabla Usuario
            $data = array(
                'id_rol' => 'empleado',
                'nom_usuario' => $empleado['nom_empleado'],
                'nom_login' => $empleado['correo'],
                'activo' => array_key_exists('activo', $empleado) ? 1 : 0,
            );
            // guardar
            $this->usuario_model->save($data);
            $id_usuario = $this->usuario_model->getInsertID();

            // actualizar id_usuario en tabla Empleado
            $data = array(
                'id_empleado' => $empleado['id_empleado'],
                'id_usuario' => $id_usuario,
            );
            // guardar
            $this->empleado_model->save($data);

            $accion = 'agregó';
            $id_usuario = $this->usuario_model->getInsertID();

            // registro en bitacora
            $entidad = 'usuario';
            $valor = $id_usuario . " " .$empleado['nom_empleado'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
    }

    public function guardar_activo()
    {
        $empleado = $this->request->getPost();
        if ($empleado) {
            $accion = 'modificó';
            $activo = array_key_exists('activo', $empleado) ? 'activo' : 'inactivo';

            // guardado tabla Usuario
            $data = array(
                'id_usuario' => $empleado['id_usuario'],
                'activo' => array_key_exists('activo', $empleado) ? 1 : 0,
            );
            $this->usuario_model->save($data);

            // guardado tabla Empleado
            $data = array(
                'id_empleado' => $empleado['id_empleado'],
                'activo' => array_key_exists('activo', $empleado) ? 1 : 0,
            );
            $this->empleado_model->save($data);

            // registro en bitacora
            $entidad = 'empleado';
            $valor = $empleado['id_empleado'] . " " .$empleado['nom_empleado'] . " " . $activo;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("empleado"));
    }

    public function eliminar()
    {
        $empleado = $this->request->getPost();
        if ($empleado) {
            $id_empleado = $empleado['id_empleado'];
            $url_actual = $empleado['url_actual'];
            $id_usuario = $empleado['id_usuario'];

            // registro en bitacora
            $empleado = $this->empleado_model->get_empleado($id_empleado);
            $accion = "eliminó";
            $entidad = 'empleado';
            $valor = $empleado['id_empleado'] . " " . $empleado['nom_empleado'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminar usuario asociado
            $this->usuario_model->where('id_usuario', $id_usuario)->delete();

            // eliminado
            $this->empleado_model->delete($id_empleado);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url("empleado"));
        }
    }

}
