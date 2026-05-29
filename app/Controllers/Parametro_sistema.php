<?php

namespace App\Controllers;

class Parametro_sistema extends BaseController
{
    public function __construct()
    {
        $this->parametro_sistema_model = model('Parametro_sistema_model');
    }

    public function index()
    {
        $data['parametros_sistema'] = $this->parametro_sistema_model->get_parametros_sistema();

        return view('templates/header')
            .view('catalogos/parametro_sistema/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_parametro_sistema)
    {
        $data['parametro_sistema'] = $this->parametro_sistema_model->get_parametro_sistema($id_parametro_sistema);

        return view('templates/header')
            .view('catalogos/parametro_sistema/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/parametro_sistema/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $parametro_sistema = $this->request->getPost();
        if ($parametro_sistema) {
            $data = [];
            if (array_key_exists('id_parametro_sistema', $parametro_sistema)) {
                $data += array(
                    'id_parametro_sistema' => $parametro_sistema['id_parametro_sistema'],
                );
            }
            $data += array(
                'nom_parametro_sistema' => $parametro_sistema['nom_parametro_sistema'],
                'valor' => $parametro_sistema['valor'],
            );
            // guardar
            $this->parametro_sistema_model->save($data);

            if (array_key_exists('id_parametro_sistema', $parametro_sistema)) {
                $accion = 'modificó';
                $id_parametro_sistema = $parametro_sistema['id_parametro_sistema'];
            } else {
                $accion = 'agregó';
                $id_parametro_sistema = $this->parametro_sistema_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'parametro_sistema';
            $valor = $id_parametro_sistema . " " .$parametro_sistema['nom_parametro_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('parametro_sistema'));
    }

    public function eliminar()
    {
        $parametro_sistema = $this->request->getPost();
        if ($parametro_sistema) {
            $id_parametro_sistema = $parametro_sistema['id_parametro_sistema'];
            $url_actual = $parametro_sistema['url_actual'];

            // registro en bitacora
            $parametro_sistema = $this->parametro_sistema_model->get_parametro_sistema($id_parametro_sistema);
            $accion = "eliminó";
            $entidad = 'parametro_sistema';
            $valor = $parametro_sistema['id_parametro_sistema'] . " " . $parametro_sistema['nom_parametro_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->parametro_sistema_model->delete($id_parametro_sistema);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('parametro_sistema'));
        }
    }

}
