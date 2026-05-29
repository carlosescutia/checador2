<?php

namespace App\Controllers;

class Acceso_sistema extends BaseController
{
    public function __construct()
    {
        $this->acceso_sistema_model = model('Acceso_sistema_model');
        $this->rol_model = model('Rol_model');
        $this->opcion_sistema_model = model('Opcion_sistema_model');
    }

    public function index()
    {
        $data['accesos_sistema'] = $this->acceso_sistema_model->get_accesos_sistema();

        return view('templates/header')
            .view('catalogos/acceso_sistema/lista', $data)
            .view('templates/footer');
    }

    public function nuevo()
    {
        $data['roles'] = $this->rol_model->get_roles();
        $data['opciones_sistema'] = $this->opcion_sistema_model->get_opciones_sistema();

        return view('templates/header')
            .view('catalogos/acceso_sistema/nuevo', $data)
            .view('templates/footer');
    }

    public function guardar()
    {
        $acceso_sistema = $this->request->getPost();
        if ($acceso_sistema) {
            $data = array(
                'id_rol' => $acceso_sistema['id_rol'],
                'cod_opcion_sistema' => $acceso_sistema['cod_opcion_sistema'],
            );
            // guardar
            $this->acceso_sistema_model->save($data);

            // registro en bitacora
            $accion = 'agregó';
            $entidad = 'acceso_sistema';
            $valor = $acceso_sistema['id_rol'] . " " . $acceso_sistema['cod_opcion_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);
        }
        return redirect()->to(site_url("acceso_sistema"));
    }

    public function eliminar()
    {
        $acceso_sistema = $this->request->getPost();
        if ($acceso_sistema) {
            $id_acceso_sistema = $acceso_sistema['id_acceso_sistema'];
            $url_actual = $acceso_sistema['url_actual'];

            // registro en bitacora
            $acceso_sistema = $this->acceso_sistema_model->get_acceso_sistema($id_acceso_sistema);
            $accion = "eliminó";
            $entidad = 'acceso_sistema';
            $valor = $acceso_sistema['id_rol'] . " " . $acceso_sistema['cod_opcion_sistema'];
            $this->fn_sis->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->acceso_sistema_model->delete($id_acceso_sistema);

            return redirect()->to($url_actual);
        } else {
            return redirect()->to(site_url('acceso_sistema'));
        }

    }

}
