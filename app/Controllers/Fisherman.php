<?php

namespace App\Controllers;

use App\Models\modelGateway;
use App\Models\modelFisherman;
use App\Models\modelAll;

class Fisherman extends BaseController
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

    public function index($gatewayChoice)
    {
        session();

        $gateway = $this->modelGateway->findAll();
        $queryGatewayChoice = $this->modelGateway->search($gatewayChoice)->getResult();

        if (count($queryGatewayChoice) === 0) {
            $gatewayChoice1 = '00000';
        } else {
            $gatewayChoice1 = $gatewayChoice;
        }

        $xyz = $this->modelFisherman->findAll();
        if (count($xyz) === 0) {
            $xyz = [
                [
                    'id' => 0,
                    'fisherman_gateway' => '00000',
                    'fisherman_id' => '00000-00000',
                    'fisherman_name' => 'unknown fisherman'
                ]
            ];
        }
        $endFisherman = end($xyz);

        $searchKeyword = $this->request->getPost('searchKeyword');
        if ($searchKeyword) {
            $abc = $this->modelFisherman->fishermanNameSearch($gatewayChoice, $searchKeyword)->getResult();
            if (count($abc) === 0) {
                $newObject = new \stdClass;
                $newObject->id = 0;
                $newObject->fisherman_gateway = '00000';
                $newObject->fisherman_id = '00000-00000';
                $newObject->fisherman_name = 'unknown fisherman';
                $fisherman[] = $newObject;
            } else {
                $fisherman = $abc;
            }
        } else {
            $abc = $this->modelFisherman->gatewayFilter($gatewayChoice)->getResult();
            if (count($abc) === 0) {
                $newObject = new \stdClass;
                $newObject->id = 0;
                $newObject->fisherman_gateway = '00000';
                $newObject->fisherman_id = '00000-00000';
                $newObject->fisherman_name = 'unknown fisherman';
                $fisherman[] = $newObject;
            } else {
                $fisherman = $abc;
            }
        }

        $dataFisherman = [
            'gatewayChoice' => $gatewayChoice1,
            'gateway' => $gateway,
            'fisherman' => $fisherman,
            'endFisherman' => $endFisherman,
            'validation' => \Config\Services::validation()
        ];

        return view('viewFisherman', $dataFisherman);
    }

    public function fishermanSave()
    {
        if ($this->request->getPost('method') == "add") {
            $fisherman = $this->modelFisherman->findAll();
            $matchStat = 0;
            foreach ($fisherman as $fisherman) {
                if ($matchStat == 0) {
                    if ($this->request->getPost('fishermanGateway') == $fisherman['fisherman_gateway']) {
                        if ($this->request->getPost('fishermanName') == $fisherman['fisherman_name']) {
                            $matchStat = 1;
                        }
                    }
                }
            }
            if ($matchStat == 1) {
                $ruleFishermanName = 'required|is_unique[fisherman_data.fisherman_name]';
            } else {
                $ruleFishermanName = 'required';
            }
            if (!$this->validate([
                'fishermanId' => [
                    'rules' => 'required|is_unique[fisherman_data.fisherman_id]',
                    'errors' => [
                        'required' => 'fisherman Id harus diisi.',
                        'is_unique' => 'fisherman Id sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'fishermanName' => [
                    'rules' => $ruleFishermanName,
                    'errors' => [
                        'required' => 'fisherman name harus diisi.',
                        'is_unique' => 'fisherman name sudah ada atau sudah pernah dihapus.'
                    ]
                ]
            ])) {

                $validation = \Config\Services::validation();
                return redirect()->to('/Fisherman/' . $this->request->getPost('fishermanGateway'))->withInput()->with('validation', $validation);
            }

            $this->modelFisherman->insert([
                "id" => $this->request->getPost('id'),
                "fisherman_gateway" => $this->request->getPost('fishermanGateway'),
                "fisherman_id" => $this->request->getPost('fishermanId'),
                "fisherman_name" => $this->request->getPost('fishermanName')
            ]);

            session()->setFlashdata('pesanAdd', 'Berhasil mengubah data Fisherman.');
            return redirect()->to('/Fisherman/' . $this->request->getPost('fishermanGateway'));
        } elseif ($this->request->getPost('method') == "edit") {
            $fisherman = $this->modelFisherman->findAll();
            $matchStat = 0;
            foreach ($fisherman as $fisherman) {
                if ($matchStat == 0) {
                    if ($this->request->getPost('fishermanGateway') == $fisherman['fisherman_gateway']) {
                        if ($this->request->getPost('fishermanName') == $fisherman['fisherman_name']) {
                            $matchStat = 1;
                        }
                    }
                }
            }

            $dataOld = $this->modelFisherman->find($this->request->getPost('id'));
            if ($dataOld['fisherman_id'] == $this->request->getPost('fishermanId')) {
                $ruleFishermanId = 'required';
            } else {
                $ruleFishermanId = 'required|is_unique[fisherman_data.fisherman_id]';
            }
            if ($dataOld['fisherman_name'] == $this->request->getPost('fishermanName') or $matchStat != 1) {
                $ruleFishermanName = 'required';
            } else {
                $ruleFishermanName = 'required|is_unique[fisherman_data.fisherman_name]';
            }

            if (!$this->validate([
                'fishermanId' => [
                    'rules' => $ruleFishermanId,
                    'errors' => [
                        'required' => 'fisherman Id harus diisi.',
                        'is_unique' => 'fisherman Id sudah ada atau sudah pernah dihapus.'
                    ]
                ],
                'fishermanName' => [
                    'rules' => $ruleFishermanName,
                    'errors' => [
                        'required' => 'fisherman name harus diisi.',
                        'is_unique' => 'fisherman name sudah ada atau sudah pernah dihapus.'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/Fisherman/' . $this->request->getPost('fishermanGateway'))->withInput()->with('validation', $validation);
            }

            $id = $this->request->getPost('id');
            $this->modelFisherman->update($id, [
                "fisherman_gateway" => $this->request->getPost('fishermanGateway'),
                "fisherman_id" => $this->request->getPost('fishermanId'),
                "fisherman_name" => $this->request->getPost('fishermanName')
            ]);

            session()->setFlashdata('pesanEdit', 'Berhasil mengubah data Fisherman.');
            return redirect()->to('/Fisherman/' . $this->request->getPost('fishermanGateway'));
        } elseif ($this->request->getPost('method') == "delete") {

            $id = $this->request->getPost('id');
            $this->modelFisherman->update($id, [
                "delete_stat" => 1
            ]);

            session()->setFlashdata('pesanDelete', 'Berhasil menghapus data Fisherman.');
            return redirect()->to('/Fisherman/' . $this->request->getPost('fishermanGateway'));
        }
    }
}
