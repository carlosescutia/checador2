<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->usuario_model = model('Usuario_model');
        $this->acceso_sistema_model = model('Acceso_sistema_model');
        $this->opcion_sistema_model = model('Opcion_sistema_model');
    }

    public function index()
    {
        if ($this->session->logueado) {
            $data = [];
            $data += $this->fn_sis->get_userdata();

            $permisos_requeridos = array(
                'reporte_mentor.can_view',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $acceso = 'Puede ver reportes de mentor';
            } else {
                $acceso = 'NO Puede ver reportes de mentor';
            }

            $data['acceso'] = $acceso;

            return view('templates/header', $data)
                .view('admin/index', $data)
                .view('templates/footer');
        } else {
            return redirect()->to(site_url("login"));
        }
    }

    public function login()
    {
        $this->session->destroy();
        $data = [];
        $data['error'] = $this->session->getFlashdata('error');

        return view('admin/login', $data);
    }

    public function logout()
    {
        $this->session->destroy();

        // registro en bitacora
        $accion = 'logout';
        $entidad = '';
        $valor = '';
        $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

        return redirect()->to(site_url());
    }

    public function post_login()
    {
        if ($this->request->getPost()) {
            $nom_login = $this->request->getPost('nom_login');
            $password = $this->request->getPost('password');
            $usuario = $this->usuario_model->get_usuario_login($nom_login);
            if ($usuario) {
                if ( password_verify($password, $usuario['password']) ) {
                    $userdata = array(
                        'id_usuario' => $usuario['id_usuario'],
                        'id_rol' => $usuario['id_rol'],
                        'nom_usuario' => $usuario['nom_usuario'],
                        'nom_login' => $usuario['nom_login'],
                        'logueado' => TRUE,
                    );
                    $this->session->set($userdata);

                    // registro en bitacora
                    $accion = 'login';
                    $entidad = '';
                    $valor = '';
                    $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

                    return redirect()->to(site_url());
                } else {
                    $this->session->setFlashdata('error', 'Usuario o contraseña incorrectos');
                    return redirect()->to(site_url('login'));
                }
            } else {
                $this->session->setFlashdata('error', 'Usuario o contraseña incorrectos');
                return redirect()->to(site_url('login'));
            }
        }
    }

}
