<?php

namespace App\Models;

use CodeIgniter\Model;

class Asistencia_model extends Model
{
    protected $table = 'asistencia';
    protected $primaryKey = 'id_asistencia';
    protected $allowedFields = [
        'id_asistencia',
        'id_empleado',
        'fecha',
        'hora',
    ];

    public function get_asistencias()
    {
        $sql = ""
            ."select "
            ."e.*, a.* "
            ."from "
            ."asistencia a "
            ."left join empleado e on e.id_empleado = a.id_empleado "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_anios_disponibles()
    {
        $sql = ""
            ."select "
            ."distinct(extract(year from fecha)) as anio "
            ."from "
            ."asistencia a "
            ."order by anio desc "
            ."";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_tot_asistencias()
    {
        $sql = 'select count(*) as tot_asistencias from asistencia ;';
        $query = $this->db->query($sql);
        return $query->getRowArray()['tot_asistencias'] ?? null ;
    }

    public function get_asistencia_antigua()
    {
        $sql = "select min(fecha::text || ' ' || hora::text) as asistencia_antigua from asistencia";
        $query = $this->db->query($sql);
        return $query->getRowArray()['asistencia_antigua'] ?? null ;
    }

    public function get_asistencia_reciente()
    {
        $sql = "select max(fecha::text || ' ' || hora::text) as asistencia_reciente from asistencia";
        $query = $this->db->query($sql);
        return $query->getRowArray()['asistencia_reciente'] ?? null ;
    }

    public function existe($data)
    {
        $sql = 'select id_asistencia from asistencia where id_empleado = ? and fecha = ? and hora = ? ';
        $query = $this->db->query($sql, array($data['id_empleado'], $data['fecha'], $data['hora']));
        return $query->getNumRows();
    }

    public function guardar($data)
    {
        if ( ! $this->existe($data) ) {
            $this->db->insert('asistencia', $data);
        }
    }

}
