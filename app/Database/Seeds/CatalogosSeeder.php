<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    public function run()
    {
        $this->call('OpcionSistemaSeeder');
        $this->call('AccesoSistemaSeeder');
        $this->call('ParametroSistemaSeeder');
        $this->call('RolSeeder');
    }
}
