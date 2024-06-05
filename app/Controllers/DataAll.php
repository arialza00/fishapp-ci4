<?php

namespace App\Controllers;

use App\Models\modelAll;
use App\Models\modelGateway;

class DataAll extends BaseController
{

    protected $modelAll, $modelGateway;

    public function __construct()
    {
        $this->modelAll = new modelAll();
        $this->modelGateway = new modelGateway();
    }

    public function dataFilterTimelapse()
    {
        $a = $this->request->getPost('startTimestamp');
        $b = $this->request->getPost('endTimestamp');
        $showOpt = $this->request->getPost('showOptions');
        $fishermanId = $this->request->getPost('fishermanId');

        $startTimestamp = (int)$a;
        $endTimestamp = (int)$b;

        if ($showOpt == "1") {
            $result = $this->modelAll->filterDate($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "2") {
            $result = $this->modelAll->filterMarker2($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "3") {
            $result = $this->modelAll->filterMarker3($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "4") {
            $result = $this->modelAll->filterMarker4($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        }
        $datagateway = $this->modelGateway->search(substr($fishermanId,0,5))->getResult()[0];
        $data = [
            'GatewayLat' => $datagateway->latitude,
            'GatewayLong' => $datagateway->longitude,
            'result' => $result,
            'fishermanId' => $fishermanId
        ];

        // $data = [
        //     'result' => $result,
        //     'fishermanId' => $fishermanId
        // ];

        return $this->response->setJSON($data);
    }

    public function dataFilterLive()
    {
        $a = $this->request->getPost('startTimestamp');
        $b = $this->request->getPost('endTimestamp');
        $c = $this->request->getPost('lastId');

        $startTimestamp = (int)$a;
        $endTimestamp = (int)$b;
        $lastId = (int)$c;

        $result = $this->modelAll->filterDateLive($startTimestamp, $endTimestamp, $lastId)->getResult();

        $data = [
            'result' => $result
        ];


        return $this->response->setJSON($data);
    }
}
