<?php

namespace App\Controllers;

class Justificante_masivo extends BaseController
{
    public function __construct()
    {
        $this->justificante_masivo_model = model('Justificante_masivo_model');
        $this->tipo_cobertura_model = model('Tipo_cobertura_model');
    }

    public function detalle($id_justificante_masivo)
    {
        $data['justificante_masivo'] = $this->justificante_masivo_model->get_justificante_masivo($id_justificante_masivo);
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('justificante_masivo/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('justificante_masivo/nuevo', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $justificante_masivo = $this->request->getPost();
        if ($justificante_masivo) {
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


