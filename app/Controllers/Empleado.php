<?php

namespace App\Controllers;

class Empleado extends BaseController
{
    public function __construct()
    {
        $this->empleado_model = model('Empleado_model');
    }

    public function index()
    {
        $data['empleados'] = $this->empleado_model->get_empleados_activos();

        return view('templates/header')
            .view('empleado/index', $data)
            .view('templates/footer');
    }

}

