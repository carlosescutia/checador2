<?php

namespace App\Controllers;

class Dia_inhabil extends BaseController
{
    public function __construct()
    {
        $this->dia_inhabil_model = model('Dia_inhabil_model');
    }

    public function detalle($id_dia_inhabil)
    {
        $data['dia_inhabil'] = $this->dia_inhabil_model->get_dia_inhabil($id_dia_inhabil);

        return view('templates/header')
            .view('dia_inhabil/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        return view('templates/header')
            .view('dia_inhabil/nuevo')
            .view('templates/footer');
    }

    public function guardar()
    {
        $dia_inhabil = $this->request->getPost();
        if ($dia_inhabil) {
            $data = [];
            if (array_key_exists('id_dia_inhabil', $dia_inhabil)) {
                $data += array(
                    'id_dia_inhabil' => $dia_inhabil['id_dia_inhabil'],
                );
            }
            $data += array(
                'fecha' => $dia_inhabil['fecha'],
                'detalle' => $dia_inhabil['detalle'],
            );
            // guardar
            $this->dia_inhabil_model->save($data);

            if (array_key_exists('id_dia_inhabil', $dia_inhabil)) {
                $accion = 'modificó';
                $id_dia_inhabil = $dia_inhabil['id_dia_inhabil'];
            } else {
                $accion = 'agregó';
                $id_dia_inhabil = $this->dia_inhabil_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'dia_inhabil';
            $valor = $id_dia_inhabil . " " .$dia_inhabil['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('incidentes'));
    }

    public function eliminar()
    {
        $dia_inhabil = $this->request->getPost();
        if ($dia_inhabil) {
            $id_dia_inhabil = $dia_inhabil['id_dia_inhabil'];
            $url_actual = $dia_inhabil['url_actual'];

            // registro en bitacora
            $dia_inhabil = $this->dia_inhabil_model->get_dia_inhabil($id_dia_inhabil);
            $accion = "eliminó";
            $entidad = 'dia_inhabil';
            $valor = $dia_inhabil['id_dia_inhabil'] . " " . $dia_inhabil['fecha'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->dia_inhabil_model->delete($id_dia_inhabil);

            return redirect()->to($url_actual);

        } else {
            return redirect()->to(site_url('incidentes'));
        }
    }

}

