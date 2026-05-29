<?php

namespace App\Controllers;

class Rol extends BaseController
{
    public function __construct()
    {
        $this->rol_model = model('Rol_model');
    }

    public function index()
    {
        $data['roles'] = $this->rol_model->get_roles();

        return view('templates/header', $data)
            .view('catalogos/rol/lista', $data)
            .view('templates/footer');
    }

}
