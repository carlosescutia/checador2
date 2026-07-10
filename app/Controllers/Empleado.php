<?php

namespace App\Controllers;

class Empleado extends BaseController
{
    public function __construct()
    {
        $this->empleado_model = model('Empleado_model');
        $this->horario_model = model('Horario_model');
        $this->horario_dia_model = model('Horario_dia_model');
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
        $data['empleado'] = $this->empleado_model->get_empleado($id_empleado);
        $data['horarios_activos'] = $this->horario_model->get_horarios_activos_empleado($id_empleado);
        $data['horarios_inactivos'] = $this->horario_model->get_horarios_inactivos_empleado($id_empleado);
        $horarios_dias_tmp = $this->horario_dia_model->get_horarios_dias_empleado($id_empleado);
        $data['horarios_dias'] = array_group_by($horarios_dias_tmp, ['id_horario']);

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
            $data = [];
            if (array_key_exists('id_empleado', $empleado)) {
                $data += array(
                    'id_empleado' => $empleado['id_empleado'],
                );
            }

            $data += array(
                'cod_empleado' => $empleado['nom_empleado'],
                'nom_empleado' => $empleado['nom_empleado'],
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

    public function guardar_activo()
    {
        $empleado = $this->request->getPost();
        if ($empleado) {
            $accion = 'modificó';
            $activo = array_key_exists('activo', $empleado) ? 'activo' : 'inactivo';

            // guardado
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

            // registro en bitacora
            $empleado = $this->empleado_model->get_empleado($id_empleado);
            $accion = "eliminó";
            $entidad = 'empleado';
            $valor = $empleado['id_empleado'] . " " . $empleado['nom_empleado'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->empleado_model->delete($id_empleado);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url("empleado"));
        }
    }

}
