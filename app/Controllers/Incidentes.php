<?php

namespace App\Controllers;

class Incidentes extends BaseController
{
    public function __construct()
    {
        $this->incidente_model = model('Incidente_model');
        $this->empleado_model = model('Empleado_model');
        $this->asistencia_model = model('Asistencia_model');
        $this->dia_inhabil_model = model('Dia_inhabil_model');
        $this->justificante_masivo_model = model('Justificante_masivo_model');
        $this->justificante_model = model('Justificante_model');
        $this->parametro_sistema_model = model('Parametro_sistema_model');
    }

    public function index()
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();

        $permisos_requeridos = array(
            'rol_admin',
            'rol_operador',
        );
        $permisos_usuario = $data['permisos_usuario'];

        if (has_permission_or($permisos_requeridos, $permisos_usuario)) {
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
            $data['url_actual'] = site_url('incidentes');
            $data['incidentes_empleados'] = $this->incidente_model->get_lista_incidentes_empleados_todos($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia);
            $data['dias_inhabiles'] = $this->dia_inhabil_model->get_dias_inhabiles($anio);
            $data['justificantes_masivos'] = $this->justificante_masivo_model->get_justificantes_masivos($mes, $anio);

            return view('templates/header')
                .view('incidentes/index', $data)
                .view('templates/footer');
        } else {
            $id_empleado = $data['userdata']['id_usuario'];
            return redirect()->to(site_url('incidentes/empleado/'.$id_empleado));
        }
    }

    public function empleado($id_empleado)
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();

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
                $mes = date('m');
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

        $data['url_actual'] = site_url('incidentes/empleado/' . $id_empleado);
        $data['anios_disponibles'] = $this->asistencia_model->get_anios_disponibles();
        $data['empleado'] = $this->empleado_model->get_empleado($id_empleado);
        $data['incidentes_empleado'] = $this->incidente_model->get_incidentes_empleado($id_empleado, $mes, $anio, $tolerancia_retardo, $tolerancia_asistencia);
        $data['num_incidentes'] = $this->incidente_model->get_num_incidentes_empleado($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia, $id_empleado);
        $data['vacaciones_empleado'] = $this->justificante_model->get_vacaciones_empleado($anio, $id_empleado);
        $data['justificantes_empleado'] = $this->justificante_model->get_justificantes_empleado($mes, $anio, $id_empleado);

        return view('templates/header')
            .view('incidentes/empleado', $data)
            .view('templates/footer');
    }

}
