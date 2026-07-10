<?php

namespace App\Models;

use CodeIgniter\Model;

class Acceso_sistema_model extends Model
{
    protected $table = 'acceso_sistema';
    protected $primaryKey = 'id_acceso_sistema';
    protected $allowedFields = [
        'id_acceso_sistema',
        'id_rol',
        'cod_opcion_sistema',
    ];

    public function get_accesos_sistema() {
        // todos los accesos del sistema
        $sql = 'select acs.*, ops.nom_opcion_sistema, r.nom_rol from acceso_sistema acs left join opcion_sistema ops on acs.cod_opcion_sistema = ops.cod_opcion_sistema left join rol r on acs.id_rol = r.id_rol order by id_rol, cod_opcion_sistema;';
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_acceso_sistema($id_acceso_sistema) {
        $sql = 'select * from acceso_sistema where id_acceso_sistema = ?;';
        $query = $this->db->query($sql, array($id_acceso_sistema));
        return $query->getRowArray();
    }

    public function get_accesos_sistema_rol($id_rol) {
        $sql = ""
            ."select "
                ."acs.cod_opcion_sistema, ops.nom_opcion_sistema "
            ."from "
                ."acceso_sistema acs "
                ."left join opcion_sistema ops on acs.cod_opcion_sistema = ops.cod_opcion_sistema "
            ."where "
                ."acs.id_rol = ? "
            ."order by "
                ."acs.cod_opcion_sistema "
            ."";
        $query = $this->db->query($sql, array($id_rol));
        return $query->getResultArray();
    }


    public function get_accesos_sistema_rol_usuario($id_usuario) {
        // solo accesos del rol al que pertenece el usuario
        $sql = ""
            ."select "
                ."acs.cod_opcion_sistema, ops.nom_opcion_sistema "
            ."from "
                ."acceso_sistema acs "
                ."left join opcion_sistema ops on acs.cod_opcion_sistema = ops.cod_opcion_sistema "
                ."left join usuario usu on acs.id_rol = usu.id_rol "
            ."where "
                ."usu.id_usuario = ? "
            ."";
        $query = $this->db->query($sql, array($id_usuario));
        return $query->getResultArray();
    }

    public function get_permisos_usuario($id_usuario) {
        // accesos del usuario y del rol al que pertenece
        $sql = ""
        ."select "
        ."string_agg(cod_opcion_sistema::text, ',') as permisos "
        ."from ( "
        ."select "
        ."acs.cod_opcion_sistema "
        ."from "
        ."acceso_sistema acs "
        ."left join usuario usu on acs.id_rol = usu.id_rol "
        ."where "
        ."usu.id_usuario = ? "
        ."union "
        ."select "
        ."asu.cod_opcion_sistema "
        ."from "
        ."acceso_sistema_usuario asu "
        ."where "
        ."asu.id_usuario = ? "
        .") subconsulta "
        ."";

        $query = $this->db->query($sql, array($id_usuario, $id_usuario));
        return $query->getRowArray()['permisos'] ?? null ;
    }

    public function get_acceso_opcion_rol($cod_opcion_sistema, $id_rol) {
        // devuelve acceso que coincide con cod_opcion_sistema y rol
        $sql = 'select * from acceso_sistema where cod_opcion_sistema = ? and $id_rol = ?;';
        $query = $this->db->query($sql, array($cod_opcion_sistema, $id_rol));
        return $query->getRowArray();
    }

    public function get_roles_acceso($id_opcion_sistema) {
        // Devuelve roles con acceso a una opción
        $sql = 'select acs.id_rol, r.nom_rol from acceso_sistema acs left join opcion_sistema ops on ops.cod_opcion_sistema = acs.cod_opcion_sistema left join rol r on r.id_rol = acs.id_rol where ops.id_opcion_sistema = ?';
        $query = $this->db->query($sql, array($id_opcion_sistema));
        return $query->getResultArray();
    }

}
