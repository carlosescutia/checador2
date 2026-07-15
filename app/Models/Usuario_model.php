<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario_model extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'id_usuario',
        'id_rol',
        'nom_usuario',
        'nom_login',
        'password',
        'activo',
        'token_cambio_pwd',
    ];

    public function get_usuarios_todos()
    {
        $sql = ""
            ."select "
            ."u.* "
            ."from "
            ."usuario u "
            ."order by nom_usuario "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_usuario($id_usuario)
    {
        $sql = ""
            ."select "
            ."u.* "
            ."from "
            ."usuario u "
            ."where "
            ."u.id_usuario = ? "
            ."";
        $query = $this->db->query($sql, array($id_usuario));
        return $query->getRowArray();
    }

    public function get_usuario_login($nom_login)
    {
        $sql = ''
            .'select '
            .'u.*, '
            .'r.nom_rol, '
            .'e.id_empleado '
            .'from '
            .'usuario u '
            .'left join rol r on u.id_rol = r.id_rol '
            .'left join empleado e on e.id_usuario = u.id_usuario '
            .'where '
            .'u.nom_login = ? '
            .'and u.activo = 1 '
            .'';
        $query = $this->db->query($sql, array($nom_login));
        return $query->getRowArray();
    }

    public function get_usuario_token_cambio_pwd($token)
    {
        $sql = ''
            .'select '
            .'u.* '
            .'from '
            .'usuario u '
            .'where '
            .'u.token_cambio_pwd = ? '
            .'';
        $query = $this->db->query($sql, array($token));
        return $query->getRowArray();
    }

    public function get_existe($nom_login)
    {
        $sql = 'select 1 as existe from usuario where nom_login = ? ';
        $query = $this->db->query($sql, array($nom_login));
        return $query->getRowArray()['existe'] ?? null ;
    }

}
