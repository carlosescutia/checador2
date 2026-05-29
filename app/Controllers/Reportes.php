<?php

namespace App\Controllers;

class Reportes extends BaseController
{
    public function __construct()
    {
        $this->bitacora_model = model('Bitacora_model');
    }

    public function index()
    {
        if ($this->session->logueado) {
            $data = [];
            $data += $this->fn_sis->get_userdata();
            $data['error'] = $this->session->getFlashdata('error');

            return view('templates/header', $data)
                .view('reportes/index', $data)
                .view('templates/footer');
        } else {
            return redirect()->to(site_url("login"));
        }
    }

    public function bitacora($salida='')
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $data['error'] = $this->session->getFlashdata('error');

        $data['bitacora'] = $this->bitacora_model->get_bitacora($data['userdata']['nom_login'], $data['userdata']['id_rol'], $salida);

        if ($salida == 'csv') {
            return $this->response->download("bitacora_" . $data['userdata']['nom_login'] . '.csv', $data['bitacora']);
        } else {
            return view('templates/header', $data)
                .view('reportes/bitacora', $data)
                .view('templates/footer');
        }
    }

}
