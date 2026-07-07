<?php

namespace App\Controllers;

class Tipo_justificante extends BaseController
{
    public function __construct()
    {
        $this->tipo_justificante_model = model('Tipo_justificante_model');
    }

    public function index()
    {
        $data['tipos_justificante'] = $this->tipo_justificante_model->get_tipos_justificante();

        return view('templates/header')
            .view('catalogos/tipo_justificante/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_tipo_justificante)
    {
        $data['tipo_justificante'] = $this->tipo_justificante_model->get_tipo_justificante($id_tipo_justificante);

        return view('templates/header')
            .view('catalogos/tipo_justificante/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/tipo_justificante/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $tipo_justificante = $this->request->getPost();
        if ($tipo_justificante) {
            $data = [];
            if (array_key_exists('id_tipo_justificante', $tipo_justificante)) {
                $data += array(
                    'id_tipo_justificante' => $tipo_justificante['id_tipo_justificante'],
                );
            }
            $data += array(
                'nom_tipo_justificante' => $tipo_justificante['nom_tipo_justificante'],
            );
            // guardar
            $this->tipo_justificante_model->save($data);

            if (array_key_exists('id_tipo_justificante', $tipo_justificante)) {
                $accion = 'modificó';
                $id_tipo_justificante = $tipo_justificante['id_tipo_justificante'];
            } else {
                $accion = 'agregó';
                $id_tipo_justificante = $this->tipo_justificante_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'tipo_justificante';
            $valor = $id_tipo_justificante . " " .$tipo_justificante['nom_tipo_justificante'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('tipo_justificante'));
    }

    public function eliminar()
    {
        $tipo_justificante = $this->request->getPost();
        if ($tipo_justificante) {
            $id_tipo_justificante = $tipo_justificante['id_tipo_justificante'];
            $url_actual = $tipo_justificante['url_actual'];

            // registro en bitacora
            $tipo_justificante = $this->tipo_justificante_model->get_tipo_justificante($id_tipo_justificante);
            $accion = "eliminó";
            $entidad = 'tipo_justificante';
            $valor = $tipo_justificante['id_tipo_justificante'] . " " . $tipo_justificante['nom_tipo_justificante'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->tipo_justificante_model->delete($id_tipo_justificante);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('tipo_justificante'));
        }
    }

}

