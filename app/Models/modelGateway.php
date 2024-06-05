<?php

namespace App\Models;

use CodeIgniter\Model;

class modelGateway extends Model
{
    protected $table      = 'gateway_data';
    protected $allowedFields = ['id', 'gateway_id', 'gateway_name', 'api_key', 'latitude', 'longitude', 'delete_stat'];

    public function search($gateway_id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('gateway_data');
        $query = $builder->like('gateway_id', $gateway_id);
        $query = $builder->get();

        return $query;
    }

    public function gatewayFilterName($gatewayNameSearch)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('gateway_data');
        $builder->like('gateway_name', $gatewayNameSearch);
        $query = $builder->get();

        return $query;
    }

    public function queryAll()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('gateway_data');
        $query = $builder->get();

        return $query;
    }
}
