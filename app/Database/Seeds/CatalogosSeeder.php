<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    public function run()
    {
        /*
        ------------------
        seeding de catálogos de sistema
        ------------------
        */
        $this->call('OpcionSistemaSeeder');
        $this->call('AccesoSistemaSeeder');
        $this->call('ParametroSistemaSeeder');
        $this->call('RolSeeder');
    }
}
