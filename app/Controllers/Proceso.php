<?php

namespace App\Controllers;

class Proceso extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();
        $data['error'] = $this->session->getFlashdata('error');

        return view('templates/header')
            .view('proceso/index', $data)
            .view('templates/footer');
    }

}
