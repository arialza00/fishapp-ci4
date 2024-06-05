<?php

namespace App\Database\Seeds;

class GatewaySeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'gateway_id' => '00001',
                'gateway_name' => 'PT Selayar Abadi Sentosa',
                'api_key' => 'db01206b76954ab7b510bb908464fd6d',
                'latitude' => '-2.705',
                'longitude' => '107.6',
                'delete_stat' => 0
            ],
            [
                'gateway_id' => '00002',
                'gateway_name' => 'PT Ikan Laut Melimpah',
                'api_key' => '2e78d4cdb8f842eb924c95fb68963ff5',
                'latitude' => '3.765',
                'longitude' => '98.75',
                'delete_stat' => 0
            ],
            [
                'gateway_id' => '00003',
                'gateway_name' => 'Percobaan 1',
                'api_key' => '34883742f7cc4f07bc78c5ed48954121',
                'latitude' => '-7.208494',
                'longitude' => '112.779117',
                'delete_stat' => 0
            ],
            [
                'gateway_id' => '00004',
                'gateway_name' => 'Percobaan gisik cemandi',
                'api_key' => '46d0d68701894257a6cd417951525a58',
                'latitude' => '-7.278899',
                'longitude' => '112.795129',
                'delete_stat' => 0
            ]
        ];
        $this->db->table('gateway_data')->insertBatch($data);
    }
}