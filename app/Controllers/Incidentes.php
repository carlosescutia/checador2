<?php

namespace App\Controllers;

class Incidentes extends BaseController
{
    public function __construct()
    {
        $this->incidente_model = model('Incidente_model');
        $this->empleado_model = model('Empleado_model');
        $this->asistencia_model = model('Asistencia_model');
    }

    public function index()
    {
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
        $tolerancia_retardo = '0:15';
        $tolerancia_asistencia = '0:30';
        $data['url_actual'] = site_url('incidentes');
        $data['incidentes_empleados'] = $this->incidente_model->get_lista_incidentes_empleados_todos($mes, $anio, $tolerancia_retardo, $tolerancia_asistencia);
        $data['anios_disponibles'] = $this->asistencia_model->get_anios_disponibles();

        return view('templates/header')
            .view('incidentes/index', $data)
            .view('templates/footer');
    }

    public function empleado($id_empleado)
    {
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
        $tolerancia_retardo = '0:15';
        $tolerancia_asistencia = '0:30';

        $data['url_actual'] = site_url('incidentes/empleado/' . $id_empleado);
        $data['anios_disponibles'] = $this->asistencia_model->get_anios_disponibles();
        $data['empleado'] = $this->empleado_model->get_empleado($id_empleado);
        $data['incidentes_empleado'] = $this->incidente_model->get_incidentes_empleado($id_empleado, $mes, $anio, $tolerancia_retardo, $tolerancia_asistencia);

        return view('templates/header')
            .view('incidentes/empleado', $data)
            .view('templates/footer');
    }

}
