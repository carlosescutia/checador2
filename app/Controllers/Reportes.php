<?php

namespace App\Controllers;

class Reportes extends BaseController
{
    public function __construct()
    {
        $this->bitacora_model = model('Bitacora_model');
        $this->parametro_sistema_model = model('Parametro_sistema_model');
        $this->asistencia_model = model('Asistencia_model');
        $this->incidente_model = model('Incidente_model');
        $this->empleado_model = model('Empleado_model');
    }

    public function index()
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $data['error'] = $this->session->getFlashdata('error');

        return view('templates/header')
            .view('reportes/index', $data)
            .view('templates/footer');
    }

    public function bitacora($salida='')
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $nom_login = $data['userdata']['nom_login'];
        $id_rol = $data['userdata']['id_rol'];

        $data['bitacora'] = $this->bitacora_model->get_bitacora($nom_login, $id_rol, $salida);

        if ($salida == 'csv') {
            return $this->response->download("bitacora_" . $nom_login . '.csv', $data['bitacora']);
        } else {
            return view('templates/header')
                .view('reportes/bitacora', $data)
                .view('templates/footer');
        }
    }

    public function asistencia($salida='')
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $id_empleado = $data['userdata']['id_empleado'];
        $id_rol = $data['userdata']['id_rol'];

        $filtros = $this->request->getPost();
        if ($filtros) {
            $mes = $filtros['mes'];
            $anio = $filtros['anio'];
            $filtros_incidentes = array(
                'mes' => $mes,
                'anio' => $anio,
            );
            $this->session->set($filtros_incidentes);
        } else {
            if ( $this->session->mes ) {
                $mes = $this->session->mes;
            } else {
                $mes = date('n');
            }
            if ( $this->session->anio ) {
                $anio = $this->session->anio;
            } else {
                $anio = date('Y');
            }
        }
        $data['mes'] = $mes;
        $data['anio'] = $anio;
        $tolerancia_retardo = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_retardo');
        $tolerancia_asistencia = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_asistencia');
        $data['anios_disponibles'] = $this->asistencia_model->get_anios_disponibles();
        $data['url_actual'] = site_url('reportes/asistencia');

        $incidentes = $this->incidente_model->get_incidentes_empleados_mes($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol, $salida);

        if ($salida == 'csv') {
            return $this->response->download("asistencia_" . $mes . '_' . $anio . '.csv', $incidentes);
        } else {
            $estado = 'activos';
            $data['empleados'] = $this->empleado_model->get_empleados_reporte($estado, $id_empleado, $id_rol);

            $data['incidentes_empleados'] = array_group_by($incidentes, ['id_empleado']);

            $num_incidentes = $this->incidente_model->get_num_incidentes_empleados_mes($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol);
            $data['num_incidentes'] = array_group_by($num_incidentes, ['id_empleado']);

            return view('templates/header')
                .view('reportes/asistencia', $data)
                .view('templates/footer');
        }
    }

    public function incidentes($salida='')
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $id_empleado = $data['userdata']['id_empleado'];
        $id_rol = $data['userdata']['id_rol'];

        $filtros = $this->request->getPost();
        if ($filtros) {
            $fech_ini = $filtros['fech_ini'];
            $fech_fin = $filtros['fech_fin'];
            $filtros_incidentes = array(
                'fech_ini' => $fech_ini,
                'fech_fin' => $fech_fin,
            );
            $this->session->set($filtros_incidentes);
        } else {
            if ( $this->session->fech_ini ) {
                $fech_ini = $this->session->fech_ini;
            } else {
                $fech_ini = date('Y-m-d');
            }
            if ( $this->session->fech_fin ) {
                $fech_fin = $this->session->fech_fin;
            } else {
                $fech_fin = date('Y-m-d');
            }
        }
        $data['fech_ini'] = $fech_ini;
        $data['fech_fin'] = $fech_fin;
        $tolerancia_retardo = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_retardo');
        $tolerancia_asistencia = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_asistencia');
        $data['url_actual'] = site_url('reportes/incidentes');

        $incidentes = $this->incidente_model->get_incidentes_empleados_periodo($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol, $salida);

        if ($salida == 'csv') {
            return $this->response->download("incidentes_" . $fech_ini . '_' . $fech_fin . '.csv', $incidentes);
        } else {
            $estado = 'activos';
            $empleados = $this->empleado_model->get_empleados_reporte($estado, $id_empleado, $id_rol);

            $incidentes_empleados = array_group_by($incidentes, ['id_empleado']);
            foreach ($empleados as $empleados_item) {
                if ( ! isset($incidentes_empleados[$empleados_item['id_empleado']]) ) {
                    $incidentes_empleados[$empleados_item['id_empleado']] = [];
                }
            }
            $data['empleados'] = $empleados;
            $data['incidentes_empleados'] = $incidentes_empleados;
            $num_incidentes = $this->incidente_model->get_num_incidentes_empleados_periodo($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado, $id_rol);
            $num_incidentes = $this->incidente_model->get_num_incidentes_empleados_periodo($fech_ini, $fech_fin, $tolerancia_retardo, $tolerancia_asistencia);
            $data['num_incidentes'] = array_group_by($num_incidentes, ['id_empleado']);

            return view('templates/header')
                .view('reportes/incidentes', $data)
                .view('templates/footer');
        }
    }

}
