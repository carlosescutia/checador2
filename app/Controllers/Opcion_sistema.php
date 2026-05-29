<?php

namespace App\Controllers;

class Opcion_sistema extends BaseController
{
    public function __construct()
    {
        $this->opcion_sistema_model = model('Opcion_sistema_model');
    }

    public function index()
    {
        $data['opciones_sistema'] = $this->opcion_sistema_model->get_opciones_sistema();

        return view('templates/header')
            .view('catalogos/opcion_sistema/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_opcion_sistema)
    {
        $data['opcion_sistema'] = $this->opcion_sistema_model->get_opcion_sistema($id_opcion_sistema);

        return view('templates/header')
            .view('catalogos/opcion_sistema/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/opcion_sistema/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $opcion_sistema = $this->request->getPost();
        if ($opcion_sistema) {
            $data = [];
            if (array_key_exists('id_opcion_sistema', $opcion_sistema)) {
                $data += array(
                    'id_opcion_sistema' => $opcion_sistema['id_opcion_sistema'],
                );
            }
            $data += array(
                'cod_opcion_sistema' => $opcion_sistema['cod_opcion_sistema'],
                'nom_opcion_sistema' => $opcion_sistema['nom_opcion_sistema'],
                'otorgable' => array_key_exists('otorgable', $opcion_sistema) ? 1 : 0,
            );
            // guardar
            $this->opcion_sistema_model->save($data);

            if (array_key_exists('id_opcion_sistema', $opcion_sistema)) {
                $accion = 'modificó';
                $id_opcion_sistema = $opcion_sistema['id_opcion_sistema'];
            } else {
                $accion = 'agregó';
                $id_opcion_sistema = $this->opcion_sistema_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'opcion_sistema';
            $valor = $id_opcion_sistema . " " .$opcion_sistema['nom_opcion_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("opcion_sistema"));
    }

    public function guardar_otorgable()
    {
        $opcion_sistema = $this->request->getPost();
        if ($opcion_sistema) {
            $accion = 'modificó';
            $otorgable = array_key_exists('otorgable', $opcion_sistema) ? 'otorgable' : 'inotorgable';

            // guardado
            $data = array(
                'id_opcion_sistema' => $opcion_sistema['id_opcion_sistema'],
                'otorgable' => array_key_exists('otorgable', $opcion_sistema) ? 1 : 0,
            );
            $this->opcion_sistema_model->save($data);

            // registro en bitacora
            $entidad = 'opcion_sistema';
            $valor = $opcion_sistema['id_opcion_sistema'] . " " .$opcion_sistema['cod_opcion_sistema'] . " " . $otorgable;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("opcion_sistema"));
    }

    public function eliminar()
    {
        $opcion_sistema_frm = $this->request->getPost();
        if ($opcion_sistema_frm) {
            $id_opcion_sistema = $opcion_sistema_frm['id_opcion_sistema'];
            $url_actual = $opcion_sistema_frm['url_actual'];

            // registro en bitacora
            $opcion_sistema = $this->opcion_sistema_model->get_opcion_sistema($id_opcion_sistema);
            $accion = "eliminó";
            $entidad = 'opcion_sistema';
            $valor = $opcion_sistema['id_opcion_sistema'] . " " . $opcion_sistema['nom_opcion_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->opcion_sistema_model->delete($id_opcion_sistema);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url('opcion_sistema'));
        }
    }

}
