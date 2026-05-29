<?php

namespace App\Controllers;

use SimpleSoftwareIO\QrCode\Generator;

class Usuario extends BaseController
{
    public function __construct()
    {
        $this->usuario_model = model('Usuario_model');
        $this->rol_model = model('Rol_model');
        $this->acceso_sistema_model = model('Acceso_sistema_model');
        $this->acceso_sistema_usuario_model = model('Acceso_sistema_usuario_model');
        $this->opcion_sistema_model = model('Opcion_sistema_model');
    }

    public function index()
    {
        $data['usuarios'] = $this->usuario_model->get_usuarios_todos();

        return view('templates/header')
            .view('catalogos/usuario/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_usuario)
    {
        $qrcode = new Generator;

        $data['usuario'] = $this->usuario_model->get_usuario($id_usuario);
        $data['roles'] = $this->rol_model->get_roles();
        $data['accesos_sistema_rol'] = $this->acceso_sistema_model->get_accesos_sistema_rol_usuario($id_usuario);
        $data['accesos_sistema_usuario'] = $this->acceso_sistema_usuario_model->get_accesos_sistema_usuario($id_usuario);
        $data['opciones_sistema_otorgables'] = $this->opcion_sistema_model->get_opciones_sistema_otorgables();
        $data['qr'] = $qrcode->size(450)->format('png')->generate(site_url('usuario/nuevo_pwd/' . $data['usuario']['token_cambio_pwd']));

        return view('templates/header')
            .view('catalogos/usuario/detalle', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        $data['roles'] = $this->rol_model->get_roles();

        return view('templates/header')
            .view('catalogos/usuario/nuevo', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            $data = [];
            if (array_key_exists('id_usuario', $usuario)) {
                $data += array(
                    'id_usuario' => $usuario['id_usuario'],
                );
            }
            if (array_key_exists('password', $usuario)) {
                $data += array(
                    'password' => password_hash($usuario['password'], PASSWORD_DEFAULT),
                );
            }
            $data += array(
                'id_rol' => $usuario['id_rol'],
                'nom_usuario' => $usuario['nom_usuario'],
                'nom_login' => $usuario['nom_login'],
                'activo' => array_key_exists('activo', $usuario) ? 1 : 0,
            );
            // guardar
            $this->usuario_model->save($data);

            if (array_key_exists('id_usuario', $usuario)) {
                $accion = 'modificó';
                $id_usuario = $usuario['id_usuario'];
            } else {
                $accion = 'agregó';
                $id_usuario = $this->usuario_model->getInsertID();
            }

            // registro en bitacora
            $entidad = 'usuario';
            $valor = $id_usuario . " " .$usuario['nom_login'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url('usuario'));
    }

    public function guardar_activo()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            $accion = 'modificó';
            $activo = array_key_exists('activo', $usuario) ? 'activo' : 'inactivo';

            // guardado
            $data = array(
                'id_usuario' => $usuario['id_usuario'],
                'activo' => array_key_exists('activo', $usuario) ? 1 : 0,
            );
            $this->usuario_model->save($data);

            // registro en bitacora
            $entidad = 'usuario';
            $valor = $usuario['id_usuario'] . " " .$usuario['nom_login'] . " " . $activo;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("usuario"));
    }

    public function eliminar()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            $id_usuario = $usuario['id_usuario'];
            $url_actual = $usuario['url_actual'];

            // registro en bitacora
            $usuario = $this->usuario_model->get_usuario($id_usuario);
            $accion = "eliminó";
            $entidad = 'usuario';
            $valor = $usuario['id_usuario'] . " " . $usuario['nom_login'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->usuario_model->delete($id_usuario);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url("usuario"));
        }
    }

    public function nuevo_pwd($token)
    {
        $usuario = $this->usuario_model->get_usuario_token_cambio_pwd($token);
        if ( $usuario ) {
            $data['usuario'] = $usuario;

            return view('templates/header_pub')
                .view('catalogos/usuario/nuevo_pwd', $data)
                .view('templates/footer');
        } else {
            $data['error'] = 'El enlace proporcionado no es válido. Solicita otro e intenta de nuevo.';
        }
        return view('templates/header_pub')
            .view('catalogos/usuario/error', $data)
            .view('templates/footer');
    }

    public function actualizar_password()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            $accion = 'modificó';

            $id_usuario = $usuario['id_usuario'];
            $password = $usuario['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // eliminar token para cambio de pwd
            $data = array(
                'id_usuario' => $id_usuario,
                'token_cambio_pwd' => null,
            );
            $this->usuario_model->save($data);

            // guardado de nuevo pwd
            $data = array(
                'id_usuario' => $id_usuario,
                'password' => $password_hash,
            );
            $this->usuario_model->save($data);
        }
        return redirect()->to(site_url("login"));
    }

    public function generar_token_cambio_pwd()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            // guardado
            $data = array(
                'id_usuario' => $usuario['id_usuario'],
                'token_cambio_pwd' => $this->fn_sis->create_uuid(),
            );
            $this->usuario_model->save($data);

            // registro en bitacora
            $accion = 'modificó';
            $entidad = 'usuario';
            $valor = 'cambio de pwd: ' . $usuario['id_usuario'] ;
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to($usuario['url_actual']);
    }

    public function eliminar_token_cambio_pwd()
    {
        $usuario = $this->request->getPost();
        if ($usuario) {
            $accion = 'modificó';

            $id_usuario = $usuario['id_usuario'];

            // eliminar token para cambio de pwd
            $data = array(
                'id_usuario' => $id_usuario,
                'token_cambio_pwd' => null,
            );
            $this->usuario_model->save($data);
        }
        return redirect()->to($usuario['url_actual']);
    }

    public function existe($nom_login)
    {
        $existe = $this->usuario_model->get_existe($nom_login);
        return $existe;
    }

}
