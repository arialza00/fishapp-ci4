<?php

namespace App\Models;

use CodeIgniter\Model;

class modelFisherman extends Model
{
    protected $table      = 'fisherman_data';
    protected $allowedFields = ['id', 'fisherman_gateway', 'fisherman_id', 'fisherman_name', 'delete_stat', 'last_record'];

    public function gatewayFilter($gatewayChoice)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fisherman_data');
        $builder->like('fisherman_gateway', $gatewayChoice);
        $query = $builder->get();

        return $query;
    }

    public function fishermanNameSearch($gatewayChoice, $fishermanNameSearch)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('fisherman_data');
        $builder->like('fisherman_gateway', $gatewayChoice);
        $builder->like('fisherman_name', $fishermanNameSearch);
        $query = $builder->get();

        return $query;
    }
}
