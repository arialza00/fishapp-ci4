<?php

namespace App\Controllers;

use App\Models\modelInfoData;
use App\Models\modelFisherman;
use App\Models\modelGateway;

class InfoData extends BaseController
{
    protected $modelGateway;
    protected $modelInfoData;
    protected $modelFisherman;

    public function __construct()
    {
        $this->modelGateway = new modelGateway();
        $this->modelInfoData = new modelInfoData();
        $this->modelFisherman = new modelFisherman();
    }

    public function index()
    {
        session();
        $temp = $this->modelInfoData->filterDate()->getResult();

        $data = [
            'data' => $temp,
        ];

        return $this->response->setJSON($data);
    }
    
    private function compareByDistance($a, $b) {
        if ($a->distance < $b->distance) {
            return -1; 
        } elseif ($a->distance > $b->distance) {
            return 1;
        } else {
            return 0; 
        }
    }
    
    public function infoDataAPI()
    {
        $result = "not_match";
        $data = [];

        $api_key = $this->request->getJsonVar('api_key');
        $gatewayArr = $this->modelGateway->findAll();
        $gatewayAns = "";

        for ($b = 0; $b < count($gatewayArr); $b++) {
            if ($gatewayArr[$b]['api_key'] == $api_key and $gatewayArr[$b]['delete_stat'] == 0) {
                $gatewayAns = $gatewayArr[$b]['gateway_id'];
            }
        }

        $fishermanArr = $this->modelFisherman->gatewayFilter($gatewayAns)->getResult();

        $fishermanId = $this->request->getJsonVar('fishermanId');
        $lat = $this->request->getJsonVar('lat');
        $long = $this->request->getJsonVar('long');

        for ($f = 0; $f < count($fishermanArr); $f++) {
            if ($fishermanArr[$f]->delete_stat == 0 and $fishermanArr[$f]->fisherman_id == $fishermanId) {
                $result = "ok";
                $temp = $this->modelInfoData->filterDateAPI()->getResult();
                $earthRadius = 6371;
                
                foreach ($temp as $row) {
                    $lat1 = deg2rad($lat);
                    $lon1 = deg2rad($long);
                    $lat2 = deg2rad($row->latitude);
                    $lon2 = deg2rad($row->longitude);
                
                    $latDiff = $lat2 - $lat1;
                    $lonDiff = $lon2 - $lon1;
                
                    $a = sin($latDiff / 2) * sin($latDiff / 2) + cos($lat1) * cos($lat2) * sin($lonDiff / 2) * sin($lonDiff / 2);
                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    $distance = $earthRadius * $c;
                
                    $y = sin($lonDiff) * cos($lat2);
                    $x = cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($lonDiff);
                
                  //  $bearing = atan2($y, $x);
                //    $bearing = rad2deg($bearing);
                  //  $bearing = ($bearing + 360) % 360;
                    
                    $tempData = $row;
                    $tempData->distance = $distance;
                  //  $tempData->bearing = $bearing;
                    
                    if ($distance < floatval($row->radius)) {
                        $tempData->status = "in range";
                    } else {
                        $tempData->status = "out of range";
                    }
                    array_push($data, $tempData);
                }
            }
        }
        
        usort($data, array($this, 'compareByDistance'));

        $data = [
            'data' => $data,
            'result' => $result
        ];

        return $this->response->setJSON($data);
    }
    
    public function infoDataSave()
    {
        if ($this->request->getPost('method') == "add") {
            $insertedData = [
                "start_time" => $this->request->getPost('startDate'),
                "finish_time" => $this->request->getPost('endDate'),
                "latitude" => $this->request->getPost('latitude'),
                "longitude" => $this->request->getPost('longitude'),
                "radius" => $this->request->getPost('radius'),
                "stat" => $this->request->getPost('stat'),
                "delete_stat" => 0,
            ];
        
            $insertedId = $this->modelInfoData->insert($insertedData);
        
            $data = [
                'result' => "success add",
                'data' => array_merge($insertedData, ['id' => $insertedId]),
            ];
        
            return $this->response->setJSON($data);
        } elseif ($this->request->getPost('method') == "delete") {
            $id = $this->request->getPost('id');
            $this->modelInfoData->update($id, [
                "delete_stat" => 1
            ]);
            
            $data = [
                'result' => "success delete",
            ];
        }
    }
}