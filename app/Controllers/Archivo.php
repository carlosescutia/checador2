<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Archivo extends BaseController
{
    public function __construct()
    {
        $this->recurso_model = model('Recurso_model');
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

    public function subir_recurso()
    {
        $archivo = $this->request->getPost();
        if ($archivo) {

            $up_dir = $archivo['up_dir'];
            $url_actual = $archivo['url_actual'];
            $id_recurso = $archivo['id_recurso'];
            $archivo_actual = $archivo['archivo_actual'];

            $validationRule = [
                'userfile' => [
                    'label' => 'Archivo a subir',
                    'rules' => [
                        'uploaded[userfile]',
                        'max_size[userfile, 30720]',
                        'mime_in[userfile,application/pdf,application/zip,video/mpeg,video/mp4,image/jpg,image/jpeg,image/png,image/webp]',
                    ],
                ],
            ];

            if (! $this->validateData([], $validationRule)) {
                $this->session->setFlashdata('error', $this->validator->getErrors()['userfile']);
                return redirect()->to($url_actual);
            }

            $rec = $this->request->getFile('userfile');

            if (! $rec->hasMoved()) {
                // move(destination_path, filename, overwrite)
                $extension = $rec->guessExtension();
                $nombre_archivo = $this->fn_sis->create_uuid() . '.' . $extension;
                $rec->move(ROOTPATH.'public/'.$up_dir, $nombre_archivo, true);

                // actualizar archivo y url en recurso
                $data = array(
                    'id_recurso' => $id_recurso,
                    'url' => base_url($up_dir . $nombre_archivo),
                    'archivo' => $nombre_archivo,
                );
                // guardar
                $this->recurso_model->save($data);

                // eliminar archivo anterior
                $archivo_anterior = $up_dir . $archivo_actual;
                if ( file_exists($archivo_anterior) and $archivo_anterior !== $up_dir ) {
                    $status = unlink($archivo_anterior) ? 'Se eliminó el archivo '.$archivo_anterior : 'Error al eliminar el archivo '.$archivo_anterior;
                }

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

    public function eliminar_recurso()
    {
        $recurso = $this->request->getPost();
        if ($recurso) {
            $id_recurso = $recurso['id_recurso'];
            $up_dir = $recurso['up_dir'];
            $nombre_archivo = $recurso['nombre_archivo'];
            $url_actual = $recurso['url_actual'];
            $nombre_archivo_fs = $up_dir . $nombre_archivo;
            $nombre_archivo_url = base_url($up_dir . $nombre_archivo);

            // Eliminar archivo
            if ( file_exists($nombre_archivo_fs) and $nombre_archivo_fs !== $up_dir ) {
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

            // actualizar archivo y url en recurso
            $data = array(
                'id_recurso' => $id_recurso,
                'url' => 'actualice la url',
                'archivo' => null,
            );
            // guardar
            $this->recurso_model->save($data);

            // registro en bitacora
            $accion = "eliminó";
            $entidad = 'recurso';
            $valor = $recurso['id_recurso'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to($url_actual);
    }

}
