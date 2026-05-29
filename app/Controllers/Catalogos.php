<?php

namespace App\Controllers;

class Catalogos extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [];
        $data += $this->fn_sis->get_userdata();

        return view('templates/header')
            .view('catalogos/lista', $data)
            .view('templates/footer');
    }

}
