<?php

namespace App\Controllers;

class Tipo_cobertura extends BaseController
{
    public function __construct()
    {
        $this->tipo_cobertura_model = model('Tipo_cobertura_model');
    }

    public function index()
    {
        $data['tipos_cobertura'] = $this->tipo_cobertura_model->get_tipos_cobertura();

        return view('templates/header')
            .view('catalogos/tipo_cobertura/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_tipo_cobertura)
    {
        $data['tipo_cobertura'] = $this->tipo_cobertura_model->get_tipo_cobertura($id_tipo_cobertura);

        return view('templates/header')
            .view('catalogos/tipo_cobertura/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/tipo_cobertura/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $tipo_cobertura = $this->request->getPost();
        if ($tipo_cobertura) {
            $data = [];
            if (array_key_exists('id_tipo_cobertura', $tipo_cobertura)) {
                $data += array(
                    'id_tipo_cobertura' => $tipo_cobertura['id_tipo_cobertura'],
                );
            }
            $data += array(
                'nom_tipo_cobertura' => $tipo_cobertura['nom_tipo_cobertura'],
            );
            // guardar
            $this->tipo_cobertura_model->save($data);

            if (array_key_exists('id_tipo_cobertura', $tipo_cobertura)) {
                $accion = 'modificó';
                $id_tipo_cobertura = $tipo_cobertura['id_tipo_cobertura'];
            } else {
                $accion = 'agregó';
                $id_tipo_cobertura = $this->tipo_cobertura_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'tipo_cobertura';
            $valor = $id_tipo_cobertura . " " .$tipo_cobertura['nom_tipo_cobertura'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('tipo_cobertura'));
    }

    public function eliminar()
    {
        $tipo_cobertura = $this->request->getPost();
        if ($tipo_cobertura) {
            $id_tipo_cobertura = $tipo_cobertura['id_tipo_cobertura'];
            $url_actual = $tipo_cobertura['url_actual'];

            // registro en bitacora
            $tipo_cobertura = $this->tipo_cobertura_model->get_tipo_cobertura($id_tipo_cobertura);
            $accion = "eliminó";
            $entidad = 'tipo_cobertura';
            $valor = $tipo_cobertura['id_tipo_cobertura'] . " " . $tipo_cobertura['nom_tipo_cobertura'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->tipo_cobertura_model->delete($id_tipo_cobertura);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('tipo_cobertura'));
        }
    }

}


