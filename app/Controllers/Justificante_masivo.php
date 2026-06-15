<?php

namespace App\Controllers;

class Justificante_masivo extends BaseController
{
    public function __construct()
    {
        $this->justificante_masivo_model = model('Justificante_masivo_model');
        $this->tipo_cobertura_model = model('Tipo_cobertura_model');
        $this->empleado_model = model('Empleado_model');
        $this->justificante_masivo_empleado_model = model('Justificante_masivo_empleado_model');
        $this->periodo_vacacional_model = model('Periodo_vacacional_model');
        $this->justificante_masivo_periodo_model = model('Justificante_masivo_periodo_model');
    }

    public function detalle($id_justificante_masivo)
    {
        $data['justificante_masivo'] = $this->justificante_masivo_model->get_justificante_masivo($id_justificante_masivo);
        $data['empleados'] = $this->empleado_model->get_empleados_activos();
        $data['empleados_justificante_masivo'] = explode(',', $this->justificante_masivo_empleado_model->get_empleados_justificante_masivo($id_justificante_masivo));
        $data['periodos_vacacionales'] = $this->periodo_vacacional_model->get_periodos_vacacionales();
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('justificante_masivo/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        $data['empleados'] = $this->empleado_model->get_empleados_activos();
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();
        $data['periodos_vacacionales'] = $this->periodo_vacacional_model->get_periodos_vacacionales();

        return view('templates/header')
            .view('justificante_masivo/nuevo', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $justificante_masivo = $this->request->getPost();
        if ($justificante_masivo) {
            $db = \Config\Database::connect();
            $data = [];
            if (array_key_exists('id_justificante_masivo', $justificante_masivo)) {
                $data += array(
                    'id_justificante_masivo' => $justificante_masivo['id_justificante_masivo'],
                );
            }
            $data += array(
                'fecha' => $justificante_masivo['fecha'],
                'detalle' => $justificante_masivo['detalle'],
                'tipo_cobertura' => $justificante_masivo['tipo_cobertura'],
                'fech_fin' => $justificante_masivo['fech_fin'] ? $justificante_masivo['fech_fin'] : null,
            );
            // guardar
            $this->justificante_masivo_model->save($data);

            if (array_key_exists('id_justificante_masivo', $justificante_masivo)) {
                $accion = 'modificó';
                $id_justificante_masivo = $justificante_masivo['id_justificante_masivo'];
            } else {
                $accion = 'agregó';
                $id_justificante_masivo = $this->justificante_masivo_model->getInsertID();
            }

            // borrado de empleados del justificante masivo
            $this->justificante_masivo_empleado_model->where('id_justificante_masivo', $id_justificante_masivo)->delete();

            // lista de empleados
            $emps = [];
            foreach ($justificante_masivo as $key => $value) {
                if (substr($key, 0, 3) == 'chk') {
                    $emps[] = substr($key, 3, 99);
                }
            }
            $num_emps = sizeof($emps);

            // guardado de empleados del justificante masivo
            $data = [];
            foreach ($emps as $emps_item) {
                $newdata = [
                    "id_justificante_masivo" => $id_justificante_masivo,
                    "id_empleado" => $emps_item
                ];
                array_push($data, $newdata);
            }
            if ($data) {
                $db->table('justificante_masivo_empleado')->insertBatch($data);
            }

            // borrado de periodo del justificante masivo
            $this->justificante_masivo_periodo_model->where('id_justificante_masivo', $id_justificante_masivo)->delete();

            // guardado de periodo
            $tipo_cobertura = $justificante_masivo['tipo_cobertura'];
            $id_periodo_vacacional = $justificante_masivo['id_periodo_vacacional'];
            $anio = $justificante_masivo['anio'];
            if ($tipo_cobertura == 'vacaciones' and $id_periodo_vacacional and $anio) {
                $data = [
                    "id_justificante_masivo" => $id_justificante_masivo,
                    "id_periodo_vacacional" => $justificante_masivo['id_periodo_vacacional'],
                    "anio" => $justificante_masivo['anio'],
                ];
                $this->justificante_masivo_periodo_model->save($data);
            }

            // registro en bitacora
            $entidad = 'justificante_masivo';
            $valor = $id_justificante_masivo . " " .$justificante_masivo['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('incidentes'));
    }

    public function eliminar()
    {
        $justificante_masivo = $this->request->getPost();
        if ($justificante_masivo) {
            $id_justificante_masivo = $justificante_masivo['id_justificante_masivo'];
            $url_actual = $justificante_masivo['url_actual'];

            // registro en bitacora
            $justificante_masivo = $this->justificante_masivo_model->get_justificante_masivo($id_justificante_masivo);
            $accion = "eliminó";
            $entidad = 'justificante_masivo';
            $valor = $justificante_masivo['id_justificante_masivo'] . " " . $justificante_masivo['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->justificante_masivo_model->delete($id_justificante_masivo);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('incidentes'));
        }
    }

}


