<?php

namespace App\Controllers;

class Recurso extends BaseController
{
    public function __construct()
    {
        $this->recurso_model = model('Recurso_model');
    }

    public function index()
    {
        $data['recursos'] = $this->recurso_model->get_recursos_todos();

        return view('templates/header')
            .view('catalogos/recurso/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_recurso)
    {
        $data['error'] = $this->session->getFlashdata('error');
        $data['recurso'] = $this->recurso_model->get_recurso($id_recurso);

        return view('templates/header')
            .view('catalogos/recurso/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/recurso/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $recurso = $this->request->getPost();
        if ($recurso) {
            $data = [];
            if (array_key_exists('id_recurso', $recurso)) {
                $data += array(
                    'id_recurso' => $recurso['id_recurso'],
                );
            }

            $data += array(
                'nom_recurso' => $recurso['nom_recurso'],
                'url' => $recurso['url'],
                'activo' => array_key_exists('activo', $recurso) ? 1 : 0,
            );
            // guardar
            $this->recurso_model->save($data);

            if (array_key_exists('id_recurso', $recurso)) {
                $accion = 'modificó';
                $id_recurso = $recurso['id_recurso'];
            } else {
                $accion = 'agregó';
                $id_recurso = $this->recurso_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'recurso';
            $valor = $id_recurso . " " .$recurso['nom_recurso'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("recurso"));
    }

    public function eliminar()
    {
        $recurso = $this->request->getPost();
        if ($recurso) {
            $id_recurso = $recurso['id_recurso'];
            $url_actual = $recurso['url_actual'];

            // registro en bitacora
            $recurso = $this->recurso_model->get_recurso($id_recurso);
            $accion = "eliminó";
            $entidad = 'recurso';
            $valor = $recurso['id_recurso'] . " " . $recurso['nom_recurso'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminar archivo adjunto
            if ($recurso['archivo']) {
                $nombre_archivo = $recurso['archivo'];
                $up_dir = 'recs/';
                $nombre_archivo_fs = $up_dir . $nombre_archivo;
                if ( file_exists($nombre_archivo_fs) and $nombre_archivo_fs !== $up_dir ) {
                    $status = unlink($nombre_archivo_fs) ? 'Se eliminó el archivo '.$nombre_archivo : 'Error al eliminar el archivo '.$nombre_archivo;
                }
            }

            // eliminado
            $this->recurso_model->delete($id_recurso);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url("recurso"));
        }
    }

}


