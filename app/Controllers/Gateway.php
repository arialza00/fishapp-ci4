<?php

namespace App\Controllers;

use App\Models\modelGateway;
use App\Models\modelFisherman;
use App\Models\modelAll;

class Gateway extends BaseController
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

    public function index()
    {
        session();
        $xyz = $this->modelGateway->findAll();
        if (count($xyz) === 0) {
            $xyz = [
                [
                    'id' => 0,
                    'gateway_id' => '00000',
                    'gateway_name' => 'unknown gateway',
                    'api_key' => '00000000000000000000000000000000',
                    'latitude' => 0,
                    'longitude' => 0
                ]
            ];
        }
        $endGateway = end($xyz);

        $searchKeyword = $this->request->getPost('searchKeyword');
        if ($searchKeyword) {
            $abc = $this->modelGateway->gatewayFilterName($searchKeyword)->getResult();
            if (count($abc) === 0) {
                $newObject = new \stdClass;
                $newObject->id = 0;
                $newObject->gateway_id = '00000';
                $newObject->gateway_name = 'unknown gateway';
                $newObject->api_key = '00000000000000000000000000000000';
                $newObject->latitude = 0;
                $newObject->longitude = 0;
                $gateway[] = $newObject;
            } else {
                $gateway = $abc;
            }
        } else {
            $abc = $this->modelGateway->queryAll()->getResult();
            if (count($abc) === 0) {
                $newObject = new \stdClass;
                $newObject->id = 0;
                $newObject->gateway_id = '00000';
                $newObject->gateway_name = 'unknown gateway';
                $newObject->api_key = '00000000000000000000000000000000';
                $newObject->latitude = 0;
                $newObject->longitude = 0;
                $gateway[] = $newObject;
            } else {
                $gateway = $abc;
            }
        }

        $dataGateway = [
            'gateway' => $gateway,
            'endGateway' => $endGateway,
            'validation' => \Config\Services::validation()
        ];

        return view('viewGateway', $dataGateway);
    }

    public function gatewaySave()
    {
        if ($this->request->getPost('method') == "add") {
            if (!$this->validate([
                'gatewayName' => [
                    'rules' => 'required|is_unique[gateway_data.gateway_name]',
                    'errors' => [
                        'required' => 'gateway name harus diisi.',
                        'is_unique' => 'gateway name sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'gatewayId' => [
                    'rules' => 'required|is_unique[gateway_data.gateway_Id]',
                    'errors' => [
                        'required' => 'gateway Id harus diisi.',
                        'is_unique' => 'gateway Id sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'apiKey' => [
                    'rules' => 'required|is_unique[gateway_data.api_key]',
                    'errors' => [
                        'required' => 'api key harus diisi.',
                        'is_unique' => 'api key sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'latitude' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'latitude harus diisi.'
                    ]
                ],
                'longitude' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'longitude harus diisi.'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/Gateway')->withInput()->with('validation', $validation);
            }

            $this->modelGateway->insert([
                "id" => (int)$this->request->getPost('gatewayId'),
                "gateway_id" => $this->request->getPost('gatewayId'),
                "gateway_name" => $this->request->getPost('gatewayName'),
                "api_key" => $this->request->getPost('apiKey'),
                "latitude" => $this->request->getPost('latitude'),
                "longitude" => $this->request->getPost('longitude')
            ]);

            session()->setFlashdata('pesanAdd', 'Berhasil menambahkan data Gateway.');
            return redirect()->to('/Gateway');
        } elseif ($this->request->getPost('method') == "edit") {

            $dataOld = $this->modelGateway->find($this->request->getPost('id'));
            if ($dataOld['gateway_name'] == $this->request->getPost('gatewayName')) {
                $ruleGatewayName = 'required';
            } else {
                $ruleGatewayName = 'required|is_unique[gateway_data.gateway_name]';
            }
            if ($dataOld['gateway_id'] == $this->request->getPost('gatewayId')) {
                $ruleGatewayId = 'required';
            } else {
                $ruleGatewayId = 'required|is_unique[gateway_data.gateway_Id]';
            }
            if ($dataOld['api_key'] == $this->request->getPost('apiKey')) {
                $ruleApiKey = 'required';
            } else {
                $ruleApiKey = 'required|is_unique[gateway_data.api_key]';
            }

            if (!$this->validate([
                'gatewayName' => [
                    'rules' => $ruleGatewayName,
                    'errors' => [
                        'required' => 'gateway name harus diisi.',
                        'is_unique' => 'gateway name sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'gatewayId' => [
                    'rules' => $ruleGatewayId,
                    'errors' => [
                        'required' => 'gateway Id harus diisi.',
                        'is_unique' => 'gateway Id sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'apiKey' => [
                    'rules' => $ruleApiKey,
                    'errors' => [
                        'required' => 'api key harus diisi.',
                        'is_unique' => 'api key sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'latitude' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'latitude harus diisi.'
                    ]
                ],
                'longitude' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'longitude harus diisi.'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/Gateway')->withInput()->with('validation', $validation);
            }

            $id = $this->request->getPost('id');
            $this->modelGateway->update($id, [
                "gateway_id" => $this->request->getPost('gatewayId'),
                "gateway_name" => $this->request->getPost('gatewayName'),
                "api_key" => $this->request->getPost('apiKey'),
                "latitude" => $this->request->getPost('latitude'),
                "longitude" => $this->request->getPost('longitude')
            ]);

            session()->setFlashdata('pesanEdit', 'Berhasil mengubah data Gateway.');
            return redirect()->to('/Gateway');
        } elseif ($this->request->getPost('method') == "delete") {
            $gateway = $this->modelGateway->findAll();
            foreach ($gateway as $gateway) {
                if ($gateway['id'] == $this->request->getPost('id')) {
                    $gatewayId = $gateway["gateway_id"];
                }
            }

            $id = $this->request->getPost('id');
            $this->modelGateway->update($id, [
                "delete_stat" => 1
            ]);

            $fisherman = $this->modelFisherman->findAll();
            foreach ($fisherman as $fisherman) {
                if ($gatewayId == $fisherman["fisherman_gateway"]) {
                    $id = $fisherman["id"];
                    $this->modelFisherman->update($id, [
                        "delete_stat" => 1
                    ]);
                }
            }

            session()->setFlashdata('pesanDelete', 'Berhasil menghapus data Gateway.');
            return redirect()->to('/Gateway');
        }
    }
}
