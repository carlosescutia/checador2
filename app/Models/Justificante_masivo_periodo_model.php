<?php

namespace App\Models;

use CodeIgniter\Model;

class Justificante_masivo_periodo_model extends Model
{
    protected $table = 'justificante_masivo_periodo';
    protected $primaryKey = 'id_justificante_masivo_periodo';
    protected $allowedFields = [
        'id_justificante_masivo_periodo',
        'id_justificante_masivo',
        'id_periodo_vacacional',
        'anio',
    ];

}
