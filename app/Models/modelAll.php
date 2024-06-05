<?php

namespace App\Models;

use CodeIgniter\Model;

class modelAll extends Model
{
    protected $table      = 'all_data';
    protected $allowedFields = ['id', 'fisherman_id', 'timestamp', 'latitude', 'longitude', 'stat'];

    public function filterDate($startTimestamp, $endTimestamp, $fishermanId)
    {
        $nowTime = time();
        $startTimestamp1 = $startTimestamp;
        $endTimestamp1 = $endTimestamp;
        if($startTimestamp1>$nowTime){
            $startTimestamp1 = $nowTime;
        }
        if($endTimestamp1>$nowTime){
            $endTimestamp1 = $nowTime;
        }
        
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->like('fisherman_id', $fishermanId);
        $builder->where('timestamp >=', $startTimestamp1);
        $builder->where('timestamp <=', $endTimestamp1);
        $query = $builder->get();

        return $query;
    }

    public function filterMarker2($startTimestamp, $endTimestamp, $fishermanId)
    {
        $nowTime = time();
        $startTimestamp1 = $startTimestamp;
        $endTimestamp1 = $endTimestamp;
        if($startTimestamp1>$nowTime){
            $startTimestamp1 = $nowTime;
        }
        if($endTimestamp1>$nowTime){
            $endTimestamp1 = $nowTime;
        }
        
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->like('fisherman_id', $fishermanId);
        $builder->where('stat >=', 1);
        $builder->where('stat <=', 2);
        $builder->where('timestamp >=', $startTimestamp1);
        $builder->where('timestamp <=', $endTimestamp1);
        $query = $builder->get();

        return $query;
    }

    public function filterMarker3($startTimestamp, $endTimestamp, $fishermanId)
    {
        $nowTime = time();
        $startTimestamp1 = $startTimestamp;
        $endTimestamp1 = $endTimestamp;
        if($startTimestamp1>$nowTime){
            $startTimestamp1 = $nowTime;
        }
        if($endTimestamp1>$nowTime){
            $endTimestamp1 = $nowTime;
        }
        
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->like('fisherman_id', $fishermanId);
        $builder->like('stat', 1);
        $builder->where('timestamp >=', $startTimestamp1);
        $builder->where('timestamp <=', $endTimestamp1);
        $query = $builder->get();

        return $query;
    }

    public function filterMarker4($startTimestamp, $endTimestamp, $fishermanId)
    {
        $nowTime = time();
        $startTimestamp1 = $startTimestamp;
        $endTimestamp1 = $endTimestamp;
        if($startTimestamp1>$nowTime){
            $startTimestamp1 = $nowTime;
        }
        if($endTimestamp1>$nowTime){
            $endTimestamp1 = $nowTime;
        }
        
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->like('fisherman_id', $fishermanId);
        $builder->like('stat', 2);
        $builder->where('timestamp >=', $startTimestamp1);
        $builder->where('timestamp <=', $endTimestamp1);
        $query = $builder->get();

        return $query;
    }

    public function filterDateLive($startTimestamp, $endTimestamp, $lastId)
    {
        $nowTime = time();
        $startTimestamp1 = $startTimestamp;
        $endTimestamp1 = $endTimestamp;
        if($startTimestamp1>$nowTime){
            $startTimestamp1 = $nowTime;
        }
        if($endTimestamp1>$nowTime){
            $endTimestamp1 = $nowTime;
        }
        
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->where('id >', $lastId);
        $builder->where('timestamp >=', $startTimestamp1);
        $builder->where('timestamp <=', $endTimestamp1);
        $query = $builder->get();

        return $query;
    }

    public function countRecord()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('all_data');
        $builder->countAll();
        $query = $builder->get();

        return $query;
    }
}
