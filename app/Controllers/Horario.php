<?php

namespace App\Controllers;

class Horario extends BaseController
{
    public function __construct()
    {
        $this->horario_model = model('Horario_model');
        $this->horario_dia_model = model('Horario_dia_model');
        $this->parametro_sistema_model = model('Parametro_sistema_model');
    }

    public function nuevo($id_empleado)
    {
        $data['id_empleado'] = $id_empleado;
        $data['entrada_estandar'] = $this->parametro_sistema_model->get_parametro_sistema_nom('hora_entrada');
        $data['salida_estandar'] = $this->parametro_sistema_model->get_parametro_sistema_nom('hora_salida');

        return view('templates/header')
            .view('catalogos/horario/nuevo', $data)
            .view('templates/footer');
    }

    public function detalle($id_horario)
    {
        $data['horario'] = $this->horario_model->get_horario($id_horario);
        $data['id_empleado'] = $data['horario']['id_empleado'];
        $data['horario_dias'] = $this->horario_dia_model->get_horario_dias_horario($id_horario);

        return view('templates/header')
            .view('catalogos/horario/detalle', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $horario = $this->request->getPost();
        if ($horario) {
            $db = \Config\Database::connect();
            $data = [];
            if (array_key_exists('id_horario', $horario)) {
                $data += array(
                    'id_horario' => $horario['id_horario'],
                );
            }

            $data += array(
                'id_empleado' => $horario['id_empleado'],
                'fech_ini' => empty($horario['fech_ini']) ? null : $horario['fech_ini'],
                'fech_fin' => empty($horario['fech_fin']) ? null : $horario['fech_fin'],
            );
            // guardar
            $this->horario_model->save($data);

            if (array_key_exists('id_horario', $horario)) {
                $accion = 'modificó';
                $id_horario = $horario['id_horario'];
            } else {
                $accion = 'agregó';
                $id_horario = $this->horario_model->getInsertID();
            }

            // horario_dia
            // borrado de datos existentes
            $this->horario_dia_model->where('id_horario', $id_horario)->delete();

            // obtención de datos a guardar
            $data = [];
            foreach ($horario as $key => $value) {
                $indice = intval(substr($key, 0, 1));
                if ( $indice > 0 ) {
                    if (! array_key_exists($indice, $data) ) {
                        $data[$indice] = [];
                    }
                    $data[$indice] += [ 'id_horario' => $id_horario ];
                    $data[$indice] += [ 'id_dia' => $indice ];
                    $hora = substr($key, 2, 20);
                    $data[$indice] += [ $hora => $value ];
                }
            }

            // guardado
            if ($data) {
                $db->table('horario_dia')->insertBatch($data);
            }


            // registro en bitacora
            $entidad = 'horario';
            $valor = $id_horario;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('empleado/detalle/'.$horario['id_empleado']));
    }

    public function eliminar()
    {
        $horario = $this->request->getPost();
        if ($horario) {
            $id_horario = $horario['id_horario'];
            $url_actual = $horario['url_actual'];

            // registro en bitacora
            $horario = $this->horario_model->get_horario($id_horario);
            $accion = "eliminó";
            $entidad = 'horario';
            $valor = $horario['id_horario'] ;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->horario_model->delete($id_horario);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url('empleado/detalle/'.$horario['id_empleado']));
        }
    }

}

