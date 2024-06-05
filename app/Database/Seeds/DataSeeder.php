<?php

namespace App\Database\Seeds;

class DataSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('fishermanSeeder');
        $this->call('GatewaySeeder');
        $this->call('InfoDataSeeder');
        $this->call('dataAllSeeder');
        $this->call('UserSeeder');
    }
}
