<?php

namespace App\Libraries;

class Funciones_sistema {

    protected $session;

    public function __construct()
    {
        $this->session = service('session');
        $this->acceso_sistema_model = model('Acceso_sistema_model');
        $this->parametro_sistema_model = model('Parametro_sistema_model');
        $this->bitacora_model = model('Bitacora_model');
    }

    public function get_userdata()
    {
        $data['userdata'] = $this->session->get();
        $id_usuario = $data['userdata']['id_usuario'];

        $data['permisos_usuario'] = explode(',', $this->acceso_sistema_model->get_permisos_usuario($id_usuario));

        $tipo_rol = 'rol_' . $data['userdata']['id_rol'];
        array_push($data['permisos_usuario'], $tipo_rol);

        return $data;
    }

    public function registro_bitacora($accion, $entidad, $valor)
    {
        // registro en bitacora
        $data['userdata'] = $this->session->get();
        $nom_login = $data['userdata']['nom_login'];
        $nom_usuario = $data['userdata']['nom_usuario'];

        $data = array(
            'fecha' => date("Y-m-d"),
            'hora' => date("H:i"),
            'origen' => $_SERVER['REMOTE_ADDR'],
            'nom_login' => $nom_login,
            'nom_usuario' => $nom_usuario,
            'accion' => $accion,
            'entidad' => $entidad,
            'valor' => $valor
        );
        $this->bitacora_model->save($data);
    }

    public function create_uuid() {
        // V4 UUID
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for the time_low
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for the time_mid
            mt_rand(0, 0xffff),
            // 16 bits for the time_hi,
            mt_rand(0, 0x0fff) | 0x4000,

            // 8 bits and 16 bits for the clk_seq_hi_res,
            // 8 bits for the clk_seq_low,
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for the node
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public function create_random_string($size) {
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $size; $i++) {
            $index = random_int(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

}
