<?php

namespace App\Controllers;

class Justificante extends BaseController
{
    public function __construct()
    {
        $this->justificante_model = model('Justificante_model');
        $this->tipo_cobertura_model = model('Tipo_cobertura_model');
        $this->periodo_vacacional_model = model('Periodo_vacacional_model');
        $this->justificante_periodo_model = model('Justificante_periodo_model');
    }

    public function detalle($id_justificante)
    {
        $data['justificante'] = $this->justificante_model->get_justificante($id_justificante);
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('justificante/detalle', $data)
            .view('templates/footer');
    }

    public function detalle_vacacion($id_justificante)
    {
        $data['justificante'] = $this->justificante_model->get_justificante($id_justificante);
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();
        $data['periodos_vacacionales'] = $this->periodo_vacacional_model->get_periodos_vacacionales();

        return view('templates/header')
            .view('justificante/detalle_vacacion', $data)
            .view('templates/footer');
    }

    public function nueva_vacacion($id_empleado)
    {
        $data['id_empleado'] = $id_empleado;
        $data['periodos_vacacionales'] = $this->periodo_vacacional_model->get_periodos_vacacionales();

        return view('templates/header')
            .view('justificante/nueva_vacacion', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('justificante/nuevo', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $justificante = $this->request->getPost();
        if ($justificante) {
            $data = [];
            if (array_key_exists('id_justificante', $justificante)) {
                $data += array(
                    'id_justificante' => $justificante['id_justificante'],
                );
            }
            $data += array(
                'fecha' => $justificante['fecha'],
                'detalle' => $justificante['detalle'],
                'tipo_cobertura' => $justificante['tipo_cobertura'],
                'fech_fin' => $justificante['fech_fin'] ? $justificante['fech_fin'] : null,
            );
            // guardar
            $this->justificante_model->save($data);

            if (array_key_exists('id_justificante', $justificante)) {
                $accion = 'modificó';
                $id_justificante = $justificante['id_justificante'];
            } else {
                $accion = 'agregó';
                $id_justificante = $this->justificante_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'justificante';
            $valor = $id_justificante . " " .$justificante['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('incidentes'));
    }

    public function guardar_vacacion()
    {
        $vacacion = $this->request->getPost();
        if ($vacacion) {
            $data = [];
            if (array_key_exists('id_justificante', $vacacion)) {
                $data += array(
                    'id_justificante' => $vacacion['id_justificante'],
                );
            }
            $data += array(
                'id_empleado' => $vacacion['id_empleado'],
                'fecha' => $vacacion['fecha'],
                'tipo_cobertura' => $vacacion['tipo_cobertura'],
                'detalle' => $vacacion['detalle'],
                'fech_fin' => $vacacion['fech_fin'] ? $vacacion['fech_fin'] : null,
            );
            // guardar
            $this->justificante_model->save($data);

            if (array_key_exists('id_justificante', $vacacion)) {
                $accion = 'modificó';
                $id_justificante = $vacacion['id_justificante'];
            } else {
                $accion = 'agregó';
                $id_justificante = $this->justificante_model->getInsertID();
            }

            // borrado de periodo del justificante
            $this->justificante_periodo_model->where('id_justificante', $id_justificante)->delete();

            // guardado de periodo
            $data = [
                "id_justificante" => $id_justificante,
                "id_periodo_vacacional" => $vacacion['id_periodo_vacacional'],
                "anio" => $vacacion['anio'],
            ];
            $this->justificante_periodo_model->save($data);

            // registro en bitacora
            $entidad = 'justificante';
            $valor = $id_justificante . " " .$vacacion['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('incidentes/empleado/'.$vacacion['id_empleado']));
    }

    public function eliminar()
    {
        $justificante = $this->request->getPost();
        if ($justificante) {
            $id_justificante = $justificante['id_justificante'];
            $url_actual = $justificante['url_actual'];

            // registro en bitacora
            $justificante = $this->justificante_model->get_justificante($id_justificante);
            $accion = "eliminó";
            $entidad = 'justificante';
            $valor = $justificante['id_justificante'] . " " . $justificante['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->justificante_model->delete($id_justificante);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url($url_actual));
        }
    }

}



