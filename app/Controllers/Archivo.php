<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Archivo extends BaseController
{
    public function __construct()
    {
    }

    public function subir()
    {
        $archivo = $this->request->getPost();
        if ($archivo) {
            $up_dir = $archivo['up_dir'];
            $nombre_archivo = $archivo['nombre_archivo'];
            $tipo_archivo = $archivo['tipo_archivo'];
            $url_actual = $archivo['url_actual'];

            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[userfile]',
                        'ext_in[userfile,' . $tipo_archivo . ']',
                    ],
                ],
            ];
            if (! $this->validateData([], $validationRule)) {
                $this->session->setFlashdata('error', $this->validator->getErrors()['userfile']);

                return redirect()->to($url_actual);
            }

            $img = $this->request->getFile('userfile');


            if (! $img->hasMoved()) {
                // move(destination_path, filename, overwrite)
                $img->move(ROOTPATH.'public/'.$up_dir, $nombre_archivo, true);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'archivo';
                $valor = $nombre_archivo;
                $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

                return redirect()->to($url_actual);
            }
            $this->session->setFlashdata('error', 'El archivo se ha movido');

            return redirect()->to($url_actual);
        }
    }

    public function eliminar()
    {
        $archivo = $this->request->getPost();
        if ($archivo) {
            $up_dir = $archivo['up_dir'];
            $nombre_archivo = $archivo['nombre_archivo'];
            $url_actual = $archivo['url_actual'];
            $nombre_archivo_fs = $up_dir . $nombre_archivo;
            $nombre_archivo_url = base_url($up_dir . $nombre_archivo);

            // Eliminar archivo
            if ( file_exists($nombre_archivo_fs) ) {
                $status = unlink($nombre_archivo_fs) ? 'Se eliminó el archivo '.$nombre_archivo_fs : 'Error al eliminar el archivo '.$nombre_archivo_fs;

                // registro en bitacora
                $accion = 'eliminó';
                $entidad = 'archivo';
                $valor = $nombre_archivo;
                $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
            } else {
                $status = 'Archivo no existe';
                $this->session->setFlashdata('error', $status);
            }
        }

        return redirect()->to($url_actual);
    }

}
