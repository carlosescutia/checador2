<?php

namespace App\Controllers;

class Eventualidad extends BaseController
{
    public function __construct()
    {
        $this->eventualidad_model = model('Eventualidad_model');
    }

    public function index()
    {
        $data['eventualidades'] = $this->eventualidad_model->get_eventualidades();

        return view('templates/header')
            .view('catalogos/eventualidad/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_eventualidad)
    {
        $data['eventualidad'] = $this->eventualidad_model->get_eventualidad($id_eventualidad);

        return view('templates/header')
            .view('catalogos/eventualidad/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('catalogos/eventualidad/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $eventualidad = $this->request->getPost();
        if ($eventualidad) {
            $data = [];
            if (array_key_exists('id_eventualidad', $eventualidad)) {
                $data += array(
                    'id_eventualidad' => $eventualidad['id_eventualidad'],
                );
            }
            $data += array(
                'nom_eventualidad' => $eventualidad['nom_eventualidad'],
            );
            // guardar
            $this->eventualidad_model->save($data);

            if (array_key_exists('id_eventualidad', $eventualidad)) {
                $accion = 'modificó';
                $id_eventualidad = $eventualidad['id_eventualidad'];
            } else {
                $accion = 'agregó';
                $id_eventualidad = $this->eventualidad_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'eventualidad';
            $valor = $id_eventualidad . " " .$eventualidad['nom_eventualidad'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('eventualidad'));
    }

    public function eliminar()
    {
        $eventualidad = $this->request->getPost();
        if ($eventualidad) {
            $id_eventualidad = $eventualidad['id_eventualidad'];
            $url_actual = $eventualidad['url_actual'];

            // registro en bitacora
            $eventualidad = $this->eventualidad_model->get_eventualidad($id_eventualidad);
            $accion = "eliminó";
            $entidad = 'eventualidad';
            $valor = $eventualidad['id_eventualidad'] . " " . $eventualidad['nom_eventualidad'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->eventualidad_model->delete($id_eventualidad);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('eventualidad'));
        }
    }

}


