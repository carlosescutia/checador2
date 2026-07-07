<?php

namespace App\Controllers;

class Periodo_vacacional extends BaseController
{
    public function __construct()
    {
        $this->periodo_vacacional_model = model('Periodo_vacacional_model');
    }

    public function index()
    {
        $data['periodos_vacacionales'] = $this->periodo_vacacional_model->get_periodos_vacacionales();

        return view('templates/header')
            .view('catalogos/periodo_vacacional/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_periodo_vacacional)
    {
        $data['periodo_vacacional'] = $this->periodo_vacacional_model->get_periodo_vacacional($id_periodo_vacacional);

        return view('templates/header')
            .view('catalogos/periodo_vacacional/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/periodo_vacacional/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $periodo_vacacional = $this->request->getPost();
        if ($periodo_vacacional) {
            $data = [];
            if (array_key_exists('id_periodo_vacacional', $periodo_vacacional)) {
                $data += array(
                    'id_periodo_vacacional' => $periodo_vacacional['id_periodo_vacacional'],
                );
            }
            $data += array(
                'nom_periodo_vacacional' => $periodo_vacacional['nom_periodo_vacacional'],
                'orden' => $periodo_vacacional['orden'],
            );
            // guardar
            $this->periodo_vacacional_model->save($data);

            if (array_key_exists('id_periodo_vacacional', $periodo_vacacional)) {
                $accion = 'modificó';
                $id_periodo_vacacional = $periodo_vacacional['id_periodo_vacacional'];
            } else {
                $accion = 'agregó';
                $id_periodo_vacacional = $this->periodo_vacacional_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'periodo_vacacional';
            $valor = $id_periodo_vacacional . " " .$periodo_vacacional['nom_periodo_vacacional'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('periodo_vacacional'));
    }

    public function eliminar()
    {
        $periodo_vacacional = $this->request->getPost();
        if ($periodo_vacacional) {
            $id_periodo_vacacional = $periodo_vacacional['id_periodo_vacacional'];
            $url_actual = $periodo_vacacional['url_actual'];

            // registro en bitacora
            $periodo_vacacional = $this->periodo_vacacional_model->get_periodo_vacacional($id_periodo_vacacional);
            $accion = "eliminó";
            $entidad = 'periodo_vacacional';
            $valor = $periodo_vacacional['id_periodo_vacacional'] . " " . $periodo_vacacional['nom_periodo_vacacional'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->periodo_vacacional_model->delete($id_periodo_vacacional);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('periodo_vacacional'));
        }
    }

}

