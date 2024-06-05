<?php

namespace App\Controllers;

use App\Models\modelGateway;
use App\Models\modelFisherman;
use App\Models\modelAll;

class HandleAPI extends BaseController
{
    protected $modelGateway;
    protected $modelFisherman;
    protected $modelAll;

    public function __construct()
    {
        $this->modelGateway = new modelGateway();
        $this->modelFisherman = new modelFisherman();
        $this->modelAll = new modelAll();
    }

    public function lastRecordTimestamp()
    {
        $result = 0;
        $i = $this->modelAll->countAll();

        if ($i == 0) {
            $data = [
                'result' => 0
            ];
        } else {
            $j = $this->modelAll->findAll();
            $k = (int)$j[$i - 1]['timestamp'];
            $data = [
                'result' => $k
            ];
        }


        return $this->response->setJSON($data);
    }

    public function updateData()
    {
        $result = "not_match";

        $api_key = $this->request->getJsonVar('api_key');
        $gatewayArr = $this->modelGateway->findAll();

        for ($b = 0; $b < count($gatewayArr); $b++) {
            if ($gatewayArr[$b]['api_key'] == $api_key and $gatewayArr[$b]['delete_stat'] == 0) {
                $gatewayAns = $gatewayArr[$b]['gateway_id'];
            }
        }

        $fishermanArr = $this->modelFisherman->gatewayFilter($gatewayAns)->getResult();

        $fishermanId = $this->request->getJsonVar('fishermanId');
        $lat = $this->request->getJsonVar('lat');
        $long = $this->request->getJsonVar('long');
        $stat = $this->request->getJsonVar('stat');
        $timestamp = $this->request->getJsonVar('timestamp');

        for ($f = 0; $f < count($fishermanArr); $f++) {
            if ($fishermanArr[$f]->delete_stat == 0 and $fishermanArr[$f]->fisherman_id == $fishermanId) {
                $g = (int)$timestamp;
                $h = (int)$fishermanArr[$f]->last_record;
                if ($g > $h) {
                    $id = $fishermanArr[$f]->id;
                    $j = (float)$lat;
                    $k = (float)$long;
                    $l = (int)$stat;
                    $j = $j / 100000;
                    $k = $k / 100000;
                    if(($j == 0)||($k == 0))
                    {
                        $result = "gps invalid";
                    }
                    else {
                        $this->modelAll->insert([
                            "fisherman_id" => $fishermanId,
                            "timestamp" => $g,
                            "latitude" => $j,
                            "longitude" => $k,
                            "stat" => $l
                        ]);
    
                        $this->modelFisherman->update($id, [
                            "last_record" => $g
                        ]);
                        
                        $result = "ok";
                    }
                } else {
                    $result = "forbidden";
                }
            }
        }

        $data = [
            'id' => $fishermanId,
            'result' => $result
        ];

        return $this->response->setJSON($data);
    }
}
