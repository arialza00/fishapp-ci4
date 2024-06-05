<?php

namespace App\Controllers;

use App\Models\modelAll;

class dataAll extends BaseController
{

    protected $modelAll;

    public function __construct()
    {
        $this->modelAll = new modelAll();
    }

    public function dataFilterTimelapse()
    {
        $startDate = $this->request->getVar('startDate');
        $startTime = $this->request->getVar('startTime');
        $endDate = $this->request->getVar('endDate');
        $endTime = $this->request->getVar('endTime');
        $gmt = $this->request->getVar('gmt');
        $startDateArr = explode("-", $startDate);
        $startTimeArr = explode(":", $startTime);
        $endDateArr = explode("-", $endDate);
        $endTimeArr = explode(":", $endTime);
        $fishermanId = $this->request->getVar('fishermanId');
        $showOpt = $this->request->getVar('showOptions');

        $timeStampUTC = 946684800;
        $timeStampUnknown = mktime(0, 0, 0, 1, 1, 2000);
        $timeStampAnswer = $timeStampUnknown - $timeStampUTC;

        $startTimestamp = mktime($startTimeArr[0], $startTimeArr[1], 0, $startDateArr[1], $startDateArr[2], $startDateArr[0]) - $timeStampAnswer - ((int)$gmt * 3600);
        $endTimestamp = mktime($endTimeArr[0], $endTimeArr[1], 0, $endDateArr[1], $endDateArr[2], $endDateArr[0]) - $timeStampAnswer - ((int)$gmt * 3600);

        if ($showOpt == "1") {
            $result = $this->modelAll->filterDate($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "2") {
            $result = $this->modelAll->filterMarker2($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "3") {
            $result = $this->modelAll->filterMarker3($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        } elseif ($showOpt == "4") {
            $result = $this->modelAll->filterMarker4($startTimestamp, $endTimestamp, $fishermanId)->getResult();
        }

        $data = [
            'result' => $result
        ];

        return $this->response->setJSON($data);
    }
}
