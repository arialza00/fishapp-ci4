<?php

namespace App\Controllers;

use App\Models\modelGateway;
use App\Models\modelFisherman;

class Home extends BaseController
{
    protected $modelGateway;
    protected $modelFisherman;

    public function __construct()
    {
        $this->modelGateway = new modelGateway();
        $this->modelFisherman = new modelFisherman();
    }

    public function index()
    {
        $dataGateway = $this->modelGateway->findAll();
        $dataFisherman = $this->modelFisherman->findAll();

        $data = [
            'dataGateway' => $dataGateway,
            'dataFisherman' => $dataFisherman,
        ];

        return view('viewHome', $data);
    }
}
