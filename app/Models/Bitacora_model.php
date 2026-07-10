<?php

namespace App\Models;

use CodeIgniter\Model;

class Bitacora_model extends Model
{
    protected $table = 'bitacora';
    protected $primaryKey = 'id_evento';
    protected $allowedFields = [
        'id_evento',
        'fecha',
        'hora',
        'origen',
        'nom_login',
        'nom_usuario',
        'accion',
        'entidad',
        'valor',
    ];

    public function get_bitacora($nom_login, $id_rol, $salida)
    {
        $dbutil = \Config\Database::utils();

        if ($id_rol == 'operador') {
            $nom_login = '%';
        }
        if ($id_rol == 'admin') {
            $nom_login = '%';
        }

        $sql = "select b.* from bitacora b where b.nom_login LIKE ? ";

        if ($id_rol !== 'admin') {
            $sql .= " and b.nom_login not in (select nom_login from usuario where id_rol = 'admin')";
        }

        $parametros = array();
        array_push($parametros, "$nom_login");
        $sql .= ' order by b.id_evento desc;';
        $query = $this->db->query($sql, $parametros);

        if ($salida == 'csv') {
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            return $dbutil->getCSVFromResult($query, $delimiter, $newline, $enclosure);
        } else {
            return $query->getResultArray();
        }
    }

}
