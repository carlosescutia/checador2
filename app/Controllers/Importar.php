<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Importar extends BaseController
{
    public function __construct()
    {
        $this->asistencia_model = model('Asistencia_model');
        $this->parametro_sistema_model = model('Parametro_sistema_model');
    }

    public function index()
    {
        $data['tot_asistencias'] = $this->asistencia_model->get_tot_asistencias();
        $data['asistencia_antigua'] = $this->asistencia_model->get_asistencia_antigua();
        $data['asistencia_reciente'] = $this->asistencia_model->get_asistencia_reciente();

        $data['dias_cargar'] = $this->parametro_sistema_model->get_parametro_sistema_nom('dias_cargar');
        $data['tolerancia_retardo'] = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_retardo');
        $data['tolerancia_asistencia'] = $this->parametro_sistema_model->get_parametro_sistema_nom('tolerancia_asistencia');

        $data['error'] = $this->session->getFlashdata('error');

        return view('templates/header')
            .view('importar/index', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        # obtener dias a cargar del archivo a partir de hoy. Si no existe el parametro, asignar 10 dias.
        $valor = $this->parametro_sistema_model->get_parametro_sistema_nom('dias_cargar');
        $dias_cargar = $valor ? $valor : 10;

        $nombre_archivo = 'checador.csv';
        $nombre_archivo_fs = './import/' . $nombre_archivo;
        if ( file_exists($nombre_archivo_fs) ) {
            // Cargar datos en bd
            if ( ($file = fopen($nombre_archivo_fs, "r")) !== FALSE ) {
                while( ($linea = fgetcsv($file, 1000, "\t")) !== FALSE ) {
                    $id_empleado = $linea['0'];
                    $fecha = substr($linea[1], 0, strpos($linea[1], ' '));
                    $hora = substr($linea[1], strpos($linea[1], ' '), strlen($linea[1]));

                    $date1 = new \DateTime($fecha);
                    $date2 = new \DateTime(date('Y-m-d'));
                    $dias = $date1->diff($date2)->days;
                    if ($dias < $dias_cargar) {
                        if ( $linea and !is_null($linea[0]) ) {
                            $data = array(
                                'id_empleado' => $id_empleado,
                                'fecha' => $fecha,
                                'hora' => $hora,
                            );
                            if ( ! $this->asistencia_model->existe($data) ) {
                                $this->asistencia_model->save($data);
                            }
                        }
                    }
                }
                fclose($file);

                // Eliminar archivo de importación
                $status = unlink($nombre_archivo_fs) ? 'Se eliminó el archivo '.$nombre_archivo_fs : 'Error al eliminar el archivo '.$nombre_archivo_fs;
            }
        }
        return redirect()->to(site_url('importar'));
    }

}
