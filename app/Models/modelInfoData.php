<?php

namespace App\Models;

use CodeIgniter\Model;

class modelInfoData extends Model
{
    protected $table      = 'info_data';
    protected $allowedFields = ['id', 'start_time', 'finish_time', 'latitude', 'longitude', 'radius', 'stat', 'delete_stat'];
    
    public function filterDate()
    {
        $currentTimestamp = time();
        $db      = \Config\Database::connect();
        $builder = $db->table('info_data');
        $builder->where('finish_time >', $currentTimestamp);
        $query = $builder->get();

        return $query;
    }
    
    public function filterDateAPI()
    {
        $currentTimestamp = time();
        $db      = \Config\Database::connect();
        $builder = $db->table('info_data');
        $builder->where('finish_time >', $currentTimestamp)->where('start_time <', $currentTimestamp);
        $query = $builder->get();

        return $query;
    }

}