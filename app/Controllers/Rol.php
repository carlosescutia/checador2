<?php

namespace App\Controllers;

class Rol extends BaseController
{
    public function __construct()
    {
        $this->rol_model = model('Rol_model');
        $this->acceso_sistema_model = model('Acceso_sistema_model');
    }

    public function index()
    {
        $data['roles'] = $this->rol_model->get_roles();

        return view('templates/header', $data)
            .view('catalogos/rol/lista', $data)
            .view('templates/footer');
    }

    public function detalle($id_rol)
    {
        $data['rol'] = $this->rol_model->get_rol($id_rol);
        $data['accesos_sistema_rol'] = $this->acceso_sistema_model->get_accesos_sistema_rol($id_rol);

        return view('templates/header')
            .view('catalogos/rol/detalle', $data)
            .view('templates/footer');
    }

}
