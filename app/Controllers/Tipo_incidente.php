<?php

namespace App\Controllers;

class Tipo_incidente extends BaseController
{
    public function __construct()
    {
        $this->tipo_incidente_model = model('Tipo_incidente_model');
    }

    public function index()
    {
        $data['tipos_incidente'] = $this->tipo_incidente_model->get_tipos_incidente();

        return view('templates/header')
            .view('catalogos/tipo_incidente/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_tipo_incidente)
    {
        $data['tipo_incidente'] = $this->tipo_incidente_model->get_tipo_incidente($id_tipo_incidente);

        return view('templates/header')
            .view('catalogos/tipo_incidente/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/tipo_incidente/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $tipo_incidente = $this->request->getPost();
        if ($tipo_incidente) {
            $data = [];
            if (array_key_exists('id_tipo_incidente', $tipo_incidente)) {
                $data += array(
                    'id_tipo_incidente' => $tipo_incidente['id_tipo_incidente'],
                );
            }
            $data += array(
                'nom_tipo_incidente' => $tipo_incidente['nom_tipo_incidente'],
            );
            // guardar
            $this->tipo_incidente_model->save($data);

            if (array_key_exists('id_tipo_incidente', $tipo_incidente)) {
                $accion = 'modificó';
                $id_tipo_incidente = $tipo_incidente['id_tipo_incidente'];
            } else {
                $accion = 'agregó';
                $id_tipo_incidente = $this->tipo_incidente_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'tipo_incidente';
            $valor = $id_tipo_incidente . " " .$tipo_incidente['nom_tipo_incidente'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('tipo_incidente'));
    }

    public function eliminar()
    {
        $tipo_incidente = $this->request->getPost();
        if ($tipo_incidente) {
            $id_tipo_incidente = $tipo_incidente['id_tipo_incidente'];
            $url_actual = $tipo_incidente['url_actual'];

            // registro en bitacora
            $tipo_incidente = $this->tipo_incidente_model->get_tipo_incidente($id_tipo_incidente);
            $accion = "eliminó";
            $entidad = 'tipo_incidente';
            $valor = $tipo_incidente['id_tipo_incidente'] . " " . $tipo_incidente['nom_tipo_incidente'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->tipo_incidente_model->delete($id_tipo_incidente);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('tipo_incidente'));
        }
    }

}

