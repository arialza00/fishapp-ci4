<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class dataAllSeeder extends Seeder
{
    public function run()
    {
        $number = 0;

        $startTime = strtotime('2022-07-01 12:00');
        $endTime = strtotime('2022-08-20 12:00');
        $borderA = array(-2.625, 107.55);
        $borderB = array(-2.705, 107.60);
        $borderA2 = array(3.765, 98.75);
        $borderB2 = array(3.845, 98.80);
        $borderA3 = array(5.565, 126.60);
        $borderB3 = array(5.645, 126.65);
        $data = array(array());

        for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);
            $a = 5;  //random fisherman start hour
            $b = 12; //random fisherman start hour
            $c = 19; //latest fisherman back hour
            $d = 18000 - 60; //min fisherman work sec
            $e = 68400; //max fisherman back sec
            $f = 5; //min fisherman work hour
            $g = 15; //data dikirim per 15 detik
            $randStartHourFisherman1 = rand($a, $b);
            $randStartHourFisherman2 = rand($a, $b);
            $randStartHourFisherman3 = rand($a, $b);
            $randStartHourFisherman4 = rand($a, $b);
            $randStartHourFisherman5 = rand($a, $b);
            $randStartHourFisherman6 = rand($a, $b);
            $randStartHourFisherman7 = rand($a, $b);
            $randStartHourFisherman8 = rand($a, $b);
            $randStartHourFisherman9 = rand($a, $b);
            $rangeSecFishing = array($d, $e);
            $randFinishHourFisherman1 = rand($randStartHourFisherman1 + $f, $c - 1); //paling lama 1 jam sebelum "c" fisherman sudah jalan pulang
            $randFinishHourFisherman2 = rand($randStartHourFisherman2 + $f, $c - 1);
            $randFinishHourFisherman3 = rand($randStartHourFisherman3 + $f, $c - 1);
            $randFinishHourFisherman4 = rand($randStartHourFisherman4 + $f, $c - 1);
            $randFinishHourFisherman5 = rand($randStartHourFisherman5 + $f, $c - 1);
            $randFinishHourFisherman6 = rand($randStartHourFisherman6 + $f, $c - 1);
            $randFinishHourFisherman7 = rand($randStartHourFisherman7 + $f, $c - 1);
            $randFinishHourFisherman8 = rand($randStartHourFisherman8 + $f, $c - 1);
            $randFinishHourFisherman9 = rand($randStartHourFisherman9 + $f, $c - 1);
            $randHourFishermanStoptoFish1 = rand($randStartHourFisherman1 + 2, $randFinishHourFisherman1 - 2);
            $randHourFishermanStoptoFish2 = rand($randStartHourFisherman2 + 2, $randFinishHourFisherman2 - 2);
            $randHourFishermanStoptoFish3 = rand($randStartHourFisherman3 + 2, $randFinishHourFisherman3 - 2);
            $randHourFishermanStoptoFish4 = rand($randStartHourFisherman4 + 2, $randFinishHourFisherman4 - 2);
            $randHourFishermanStoptoFish5 = rand($randStartHourFisherman5 + 2, $randFinishHourFisherman5 - 2);
            $randHourFishermanStoptoFish6 = rand($randStartHourFisherman6 + 2, $randFinishHourFisherman6 - 2);
            $randHourFishermanStoptoFish7 = rand($randStartHourFisherman7 + 2, $randFinishHourFisherman7 - 2);
            $randHourFishermanStoptoFish8 = rand($randStartHourFisherman8 + 2, $randFinishHourFisherman8 - 2);
            $randHourFishermanStoptoFish9 = rand($randStartHourFisherman9 + 2, $randFinishHourFisherman9 - 2);
            $randFreqFishermanHighWave1 = rand(1, 4); //jika nilai nya 4, maka fisherman mengirim high wave.
            $randFreqFishermanHighWave2 = rand(1, 4);
            $randFreqFishermanHighWave3 = rand(1, 4);
            $randFreqFishermanHighWave4 = rand(1, 4);
            $randFreqFishermanHighWave5 = rand(1, 4);
            $randFreqFishermanHighWave6 = rand(1, 4);
            $randFreqFishermanHighWave7 = rand(1, 4);
            $randFreqFishermanHighWave8 = rand(1, 4);
            $randFreqFishermanHighWave9 = rand(1, 4);
            $randHourFishermanHighWave1 = rand($randStartHourFisherman1 + 1, $randFinishHourFisherman1 - 1);
            $randHourFishermanHighWave2 = rand($randStartHourFisherman2 + 1, $randFinishHourFisherman2 - 1);
            $randHourFishermanHighWave3 = rand($randStartHourFisherman3 + 1, $randFinishHourFisherman3 - 1);
            $randHourFishermanHighWave4 = rand($randStartHourFisherman4 + 1, $randFinishHourFisherman4 - 1);
            $randHourFishermanHighWave5 = rand($randStartHourFisherman5 + 1, $randFinishHourFisherman5 - 1);
            $randHourFishermanHighWave6 = rand($randStartHourFisherman6 + 1, $randFinishHourFisherman6 - 1);
            $randHourFishermanHighWave7 = rand($randStartHourFisherman7 + 1, $randFinishHourFisherman7 - 1);
            $randHourFishermanHighWave8 = rand($randStartHourFisherman8 + 1, $randFinishHourFisherman8 - 1);
            $randHourFishermanHighWave9 = rand($randStartHourFisherman9 + 1, $randFinishHourFisherman9 - 1);
            $koordinat1 = array(0.00000, 0.00000);
            $koordinat2 = array(0.00000, 0.00000);
            $koordinat3 = array(0.00000, 0.00000);
            $koordinat4 = array(0.00000, 0.00000);
            $koordinat5 = array(0.00000, 0.00000);
            $koordinat6 = array(0.00000, 0.00000);
            $koordinat7 = array(0.00000, 0.00000);
            $koordinat8 = array(0.00000, 0.00000);
            $koordinat9 = array(0.00000, 0.00000);
            $fishermanStoptoFishRecStat1 = 0;
            $fishermanStoptoFishRecStat2 = 0;
            $fishermanStoptoFishRecStat3 = 0;
            $fishermanStoptoFishRecStat4 = 0;
            $fishermanStoptoFishRecStat5 = 0;
            $fishermanStoptoFishRecStat6 = 0;
            $fishermanStoptoFishRecStat7 = 0;
            $fishermanStoptoFishRecStat8 = 0;
            $fishermanStoptoFishRecStat9 = 0;
            $highWaveRecStat1 = 0;
            $highWaveRecStat2 = 0;
            $highWaveRecStat3 = 0;
            $highWaveRecStat4 = 0;
            $highWaveRecStat5 = 0;
            $highWaveRecStat6 = 0;
            $highWaveRecStat7 = 0;
            $highWaveRecStat8 = 0;
            $highWaveRecStat9 = 0;

            $maxMove = 0.0002;
            $randMovSpeed1a = rand(-10, 10);
            $randMovSpeed1b = rand(-10, 10);
            $randMovSpeed2a = rand(-10, 10);
            $randMovSpeed2b = rand(-10, 10);
            $randMovSpeed3a = rand(-10, 10);
            $randMovSpeed3b = rand(-10, 10);
            $randMovSpeed4a = rand(-10, 10);
            $randMovSpeed4b = rand(-10, 10);
            $randMovSpeed5a = rand(-10, 10);
            $randMovSpeed5b = rand(-10, 10);
            $randMovSpeed6a = rand(-10, 10);
            $randMovSpeed6b = rand(-10, 10);
            $randMovSpeed7a = rand(-10, 10);
            $randMovSpeed7b = rand(-10, 10);
            $randMovSpeed8a = rand(-10, 10);
            $randMovSpeed8b = rand(-10, 10);
            $randMovSpeed9a = rand(-10, 10);
            $randMovSpeed9b = rand(-10, 10);
            $movSpeed1 = array($randMovSpeed1a / 100000, $randMovSpeed1b / 100000); //tentukan speed awal
            $movSpeed2 = array($randMovSpeed2a / 100000, $randMovSpeed2b / 100000);
            $movSpeed3 = array($randMovSpeed3a / 100000, $randMovSpeed3b / 100000);
            $movSpeed4 = array($randMovSpeed4a / 100000, $randMovSpeed4b / 100000);
            $movSpeed5 = array($randMovSpeed5a / 100000, $randMovSpeed5b / 100000);
            $movSpeed6 = array($randMovSpeed6a / 100000, $randMovSpeed6b / 100000);
            $movSpeed7 = array($randMovSpeed7a / 100000, $randMovSpeed7b / 100000);
            $movSpeed8 = array($randMovSpeed8a / 100000, $randMovSpeed8b / 100000);
            $movSpeed9 = array($randMovSpeed9a / 100000, $randMovSpeed9b / 100000);
            $spareStat1 = 0;
            $spareStat2 = 0;
            $spareStat3 = 0;
            $spareStat4 = 0;
            $spareStat5 = 0;
            $spareStat6 = 0;
            $spareStat7 = 0;
            $spareStat8 = 0;
            $spareStat9 = 0;

            for ($j = $d; $j <= $e; $j = $j + $g) {
                $hour = (int)($j / 3600);
                $minute = (int)(($j % 3600) / 60);
                $sec = (int)((($j % 3600) % 60));
                $time = (string)$hour . ':' . (string)$minute . ':' . $sec;
                if ($j >= $randStartHourFisherman1 * 3600 and $j < $randFinishHourFisherman1 * 3600) {
                    if ($j == $randStartHourFisherman1 * 3600) {
                        $number = $number + 1;
                        $koordinat1 = [$borderB[0], $borderB[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish1 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat1 == 0) {
                            $fishermanStoptoFishRecStat1 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand1X = rand(-10, 10);
                        $rand1Y = rand(-10, 10);
                        $randX = $rand1X / 1000000;
                        $randY = $rand1Y / 1000000;
                        $movSpeed1[0] = $movSpeed1[0] + $randX;
                        $movSpeed1[1] = $movSpeed1[1] + $randY;
                        if ($movSpeed1[0] <= $maxMove and $movSpeed1[0] >= -1 * $maxMove) {
                            if ($koordinat1[0] + $movSpeed1[0] <= $borderA[0] and $koordinat1[0] + $movSpeed1[0] >= $borderB[0]) {
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } elseif ($koordinat1[0] + $movSpeed1[0] > $borderA[0]) {
                                $movSpeed1[0] = -0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } else {
                                $movSpeed1[0] = 0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            }
                        } elseif ($movSpeed1[0] > $maxMove) {
                            $movSpeed1[0] = $maxMove;
                            if ($koordinat1[0] + $movSpeed1[0] <= $borderA[0] and $koordinat1[0] + $movSpeed1[0] >= $borderB[0]) {
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } elseif ($koordinat1[0] + $movSpeed1[0] > $borderA[0]) {
                                $movSpeed1[0] = -0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } else {
                                $movSpeed1[0] = 0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            }
                        } else {
                            $movSpeed1[0] = -1 * $maxMove;
                            if ($koordinat1[0] + $movSpeed1[0] <= $borderA[0] and $koordinat1[0] + $movSpeed1[0] >= $borderB[0]) {
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } elseif ($koordinat1[0] + $movSpeed1[0] > $borderA[0]) {
                                $movSpeed1[0] = -0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            } else {
                                $movSpeed1[0] = 0.0002;
                                $koordinat1[0] = $koordinat1[0] + $movSpeed1[0];
                            }
                        }

                        if ($movSpeed1[1] <= $maxMove and $movSpeed1[1] >= -1 * $maxMove) {
                            if ($koordinat1[1] + $movSpeed1[1] >= $borderA[1] and $koordinat1[1] + $movSpeed1[1] <= $borderB[1]) {
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } elseif ($koordinat1[1] + $movSpeed1[1] < $borderA[1]) {
                                $movSpeed1[1] = 0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } else {
                                $movSpeed1[1] = -0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            }
                        } elseif ($movSpeed1[1] > $maxMove) {
                            $movSpeed1[1] = $maxMove;
                            if ($koordinat1[1] + $movSpeed1[1] >= $borderA[1] and $koordinat1[1] + $movSpeed1[1] <= $borderB[1]) {
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } elseif ($koordinat1[1] + $movSpeed1[1] < $borderA[1]) {
                                $movSpeed1[1] = 0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } else {
                                $movSpeed1[1] = -0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            }
                        } else {
                            $movSpeed1[1] = -1 * $maxMove;
                            if ($koordinat1[1] + $movSpeed1[1] >= $borderA[1] and $koordinat1[1] + $movSpeed1[1] <= $borderB[1]) {
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } elseif ($koordinat1[1] + $movSpeed1[1] < $borderA[1]) {
                                $movSpeed1[1] = 0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            } else {
                                $movSpeed1[1] = -0.0002;
                                $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                            }
                        }

                        if ($randFreqFishermanHighWave1 == 4 and $randHourFishermanHighWave1 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat1[0],
                        'longitude' => $koordinat1[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman1 * 3600 and $koordinat1[0] > $borderB[0] and $koordinat1[1] < $borderB[1]) {
                    if ($spareStat1 == 0) {
                        $spareStat1 = 1;
                        $xaa = abs($borderB[0] - $koordinat1[0]);
                        $yaa = abs($borderB[1] - $koordinat1[1]);
                        $movSpeed1[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed1[1] = $yaa / (1 * 3600 / $g);
                        $koordinat1[0] = $koordinat1[0] - $movSpeed1[0];
                        $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                    } else {
                        $koordinat1[0] = $koordinat1[0] - $movSpeed1[0];
                        $koordinat1[1] = $koordinat1[1] + $movSpeed1[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat1[0],
                        'longitude' => $koordinat1[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman2 * 3600 and $j < $randFinishHourFisherman2 * 3600) {
                    if ($j == $randStartHourFisherman2 * 3600) {
                        $number = $number + 1;
                        $koordinat2 = [$borderB[0], $borderB[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish2 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat2 == 0) {
                            $fishermanStoptoFishRecStat2 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand2X = rand(-10, 10);
                        $rand2Y = rand(-10, 10);
                        $randX = $rand2X / 1000000;
                        $randY = $rand2Y / 1000000;
                        $movSpeed2[0] = $movSpeed2[0] + $randX;
                        $movSpeed2[1] = $movSpeed2[1] + $randY;
                        if ($movSpeed2[0] <= $maxMove and $movSpeed2[0] >= -1 * $maxMove) {
                            if ($koordinat2[0] + $movSpeed2[0] <= $borderA[0] and $koordinat2[0] + $movSpeed2[0] >= $borderB[0]) {
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } elseif ($koordinat2[0] + $movSpeed2[0] > $borderA[0]) {
                                $movSpeed2[0] = -0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } else {
                                $movSpeed2[0] = 0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            }
                        } elseif ($movSpeed2[0] > $maxMove) {
                            $movSpeed2[0] = $maxMove;
                            if ($koordinat2[0] + $movSpeed2[0] <= $borderA[0] and $koordinat2[0] + $movSpeed2[0] >= $borderB[0]) {
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } elseif ($koordinat2[0] + $movSpeed2[0] > $borderA[0]) {
                                $movSpeed2[0] = -0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } else {
                                $movSpeed2[0] = 0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            }
                        } else {
                            $movSpeed2[0] = -1 * $maxMove;
                            if ($koordinat2[0] + $movSpeed2[0] <= $borderA[0] and $koordinat2[0] + $movSpeed2[0] >= $borderB[0]) {
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } elseif ($koordinat2[0] + $movSpeed2[0] > $borderA[0]) {
                                $movSpeed2[0] = -0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            } else {
                                $movSpeed2[0] = 0.0002;
                                $koordinat2[0] = $koordinat2[0] + $movSpeed2[0];
                            }
                        }

                        if ($movSpeed2[1] <= $maxMove and $movSpeed2[1] >= -1 * $maxMove) {
                            if ($koordinat2[1] + $movSpeed2[1] >= $borderA[1] and $koordinat2[1] + $movSpeed2[1] <= $borderB[1]) {
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } elseif ($koordinat2[1] + $movSpeed2[1] < $borderA[1]) {
                                $movSpeed2[1] = 0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } else {
                                $movSpeed2[1] = -0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            }
                        } elseif ($movSpeed2[1] > $maxMove) {
                            $movSpeed2[1] = $maxMove;
                            if ($koordinat2[1] + $movSpeed2[1] >= $borderA[1] and $koordinat2[1] + $movSpeed2[1] <= $borderB[1]) {
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } elseif ($koordinat2[1] + $movSpeed2[1] < $borderA[1]) {
                                $movSpeed2[1] = 0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } else {
                                $movSpeed2[1] = -0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            }
                        } else {
                            $movSpeed2[1] = -1 * $maxMove;
                            if ($koordinat2[1] + $movSpeed2[1] >= $borderA[1] and $koordinat2[1] + $movSpeed2[1] <= $borderB[1]) {
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } elseif ($koordinat2[1] + $movSpeed2[1] < $borderA[1]) {
                                $movSpeed2[1] = 0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            } else {
                                $movSpeed2[1] = -0.0002;
                                $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                            }
                        }

                        if ($randFreqFishermanHighWave2 == 4 and $randHourFishermanHighWave2 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat2[0],
                        'longitude' => $koordinat2[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman2 * 3600 and $koordinat2[0] > $borderB[0] and $koordinat2[1] < $borderB[1]) {
                    if ($spareStat2 == 0) {
                        $spareStat2 = 1;
                        $xaa = abs($borderB[0] - $koordinat2[0]);
                        $yaa = abs($borderB[1] - $koordinat2[1]);
                        $movSpeed2[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed2[1] = $yaa / (1 * 3600 / $g);
                        $koordinat2[0] = $koordinat2[0] - $movSpeed2[0];
                        $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                    } else {
                        $koordinat2[0] = $koordinat2[0] - $movSpeed2[0];
                        $koordinat2[1] = $koordinat2[1] + $movSpeed2[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat2[0],
                        'longitude' => $koordinat2[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman3 * 3600 and $j < $randFinishHourFisherman3 * 3600) {
                    if ($j == $randStartHourFisherman3 * 3600) {
                        $number = $number + 1;
                        $koordinat3 = [$borderB[0], $borderB[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish3 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat3 == 0) {
                            $fishermanStoptoFishRecStat3 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand3X = rand(-10, 10);
                        $rand3Y = rand(-10, 10);
                        $randX = $rand3X / 1000000;
                        $randY = $rand3Y / 1000000;
                        $movSpeed3[0] = $movSpeed3[0] + $randX;
                        $movSpeed3[1] = $movSpeed3[1] + $randY;
                        if ($movSpeed3[0] <= $maxMove and $movSpeed3[0] >= -1 * $maxMove) {
                            if ($koordinat3[0] + $movSpeed3[0] <= $borderA[0] and $koordinat3[0] + $movSpeed3[0] >= $borderB[0]) {
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } elseif ($koordinat3[0] + $movSpeed3[0] > $borderA[0]) {
                                $movSpeed3[0] = -0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } else {
                                $movSpeed3[0] = 0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            }
                        } elseif ($movSpeed3[0] > $maxMove) {
                            $movSpeed3[0] = $maxMove;
                            if ($koordinat3[0] + $movSpeed3[0] <= $borderA[0] and $koordinat3[0] + $movSpeed3[0] >= $borderB[0]) {
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } elseif ($koordinat3[0] + $movSpeed3[0] > $borderA[0]) {
                                $movSpeed3[0] = -0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } else {
                                $movSpeed3[0] = 0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            }
                        } else {
                            $movSpeed3[0] = -1 * $maxMove;
                            if ($koordinat3[0] + $movSpeed3[0] <= $borderA[0] and $koordinat3[0] + $movSpeed3[0] >= $borderB[0]) {
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } elseif ($koordinat3[0] + $movSpeed3[0] > $borderA[0]) {
                                $movSpeed3[0] = -0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            } else {
                                $movSpeed3[0] = 0.0002;
                                $koordinat3[0] = $koordinat3[0] + $movSpeed3[0];
                            }
                        }

                        if ($movSpeed3[1] <= $maxMove and $movSpeed3[1] >= -1 * $maxMove) {
                            if ($koordinat3[1] + $movSpeed3[1] >= $borderA[1] and $koordinat3[1] + $movSpeed3[1] <= $borderB[1]) {
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } elseif ($koordinat3[1] + $movSpeed3[1] < $borderA[1]) {
                                $movSpeed3[1] = 0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } else {
                                $movSpeed3[1] = -0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            }
                        } elseif ($movSpeed3[1] > $maxMove) {
                            $movSpeed3[1] = $maxMove;
                            if ($koordinat3[1] + $movSpeed3[1] >= $borderA[1] and $koordinat3[1] + $movSpeed3[1] <= $borderB[1]) {
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } elseif ($koordinat3[1] + $movSpeed3[1] < $borderA[1]) {
                                $movSpeed3[1] = 0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } else {
                                $movSpeed3[1] = -0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            }
                        } else {
                            $movSpeed3[1] = -1 * $maxMove;
                            if ($koordinat3[1] + $movSpeed3[1] >= $borderA[1] and $koordinat3[1] + $movSpeed3[1] <= $borderB[1]) {
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } elseif ($koordinat3[1] + $movSpeed3[1] < $borderA[1]) {
                                $movSpeed3[1] = 0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            } else {
                                $movSpeed3[1] = -0.0002;
                                $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                            }
                        }

                        if ($randFreqFishermanHighWave3 == 4 and $randHourFishermanHighWave3 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00003',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat3[0],
                        'longitude' => $koordinat3[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman3 * 3600 and $koordinat3[0] > $borderB[0] and $koordinat3[1] < $borderB[1]) {
                    if ($spareStat3 == 0) {
                        $spareStat3 = 1;
                        $xaa = abs($borderB[0] - $koordinat3[0]);
                        $yaa = abs($borderB[1] - $koordinat3[1]);
                        $movSpeed3[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed3[1] = $yaa / (1 * 3600 / $g);
                        $koordinat3[0] = $koordinat3[0] - $movSpeed3[0];
                        $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                    } else {
                        $koordinat3[0] = $koordinat3[0] - $movSpeed3[0];
                        $koordinat3[1] = $koordinat3[1] + $movSpeed3[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00001-00003',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat3[0],
                        'longitude' => $koordinat3[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman4 * 3600 and $j < $randFinishHourFisherman4 * 3600) {
                    if ($j == $randStartHourFisherman4 * 3600) {
                        $number = $number + 1;
                        $koordinat4 = [$borderA2[0], $borderA2[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish4 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat4 == 0) {
                            $fishermanStoptoFishRecStat4 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand4X = rand(-10, 10);
                        $rand4Y = rand(-10, 10);
                        $randX = $rand4X / 1000000;
                        $randY = $rand4Y / 1000000;
                        $movSpeed4[0] = $movSpeed4[0] + $randX;
                        $movSpeed4[1] = $movSpeed4[1] + $randY;
                        if ($movSpeed4[0] <= $maxMove and $movSpeed4[0] >= -1 * $maxMove) {
                            if ($koordinat4[0] + $movSpeed4[0] >= $borderA2[0] and $koordinat4[0] + $movSpeed4[0] <= $borderB2[0]) {
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } elseif ($koordinat4[0] + $movSpeed4[0] > $borderB2[0]) {
                                $movSpeed4[0] = -0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } else {
                                $movSpeed4[0] = 0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            }
                        } elseif ($movSpeed4[0] > $maxMove) {
                            $movSpeed4[0] = $maxMove;
                            if ($koordinat4[0] + $movSpeed4[0] >= $borderA2[0] and $koordinat4[0] + $movSpeed4[0] <= $borderB2[0]) {
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } elseif ($koordinat4[0] + $movSpeed4[0] > $borderB2[0]) {
                                $movSpeed4[0] = -0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } else {
                                $movSpeed4[0] = 0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            }
                        } else {
                            $movSpeed4[0] = -1 * $maxMove;
                            if ($koordinat4[0] + $movSpeed4[0] >= $borderA2[0] and $koordinat4[0] + $movSpeed4[0] <= $borderB2[0]) {
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } elseif ($koordinat4[0] + $movSpeed4[0] > $borderB2[0]) {
                                $movSpeed4[0] = -0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            } else {
                                $movSpeed4[0] = 0.0002;
                                $koordinat4[0] = $koordinat4[0] + $movSpeed4[0];
                            }
                        }

                        if ($movSpeed4[1] <= $maxMove and $movSpeed4[1] >= -1 * $maxMove) {
                            if ($koordinat4[1] + $movSpeed4[1] >= $borderA2[1] and $koordinat4[1] + $movSpeed4[1] <= $borderB2[1]) {
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } elseif ($koordinat4[1] + $movSpeed4[1] < $borderA2[1]) {
                                $movSpeed4[1] = 0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } else {
                                $movSpeed4[1] = -0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            }
                        } elseif ($movSpeed4[1] > $maxMove) {
                            $movSpeed4[1] = $maxMove;
                            if ($koordinat4[1] + $movSpeed4[1] >= $borderA2[1] and $koordinat4[1] + $movSpeed4[1] <= $borderB2[1]) {
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } elseif ($koordinat4[1] + $movSpeed4[1] < $borderA2[1]) {
                                $movSpeed4[1] = 0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } else {
                                $movSpeed4[1] = -0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            }
                        } else {
                            $movSpeed4[1] = -1 * $maxMove;
                            if ($koordinat4[1] + $movSpeed4[1] >= $borderA2[1] and $koordinat4[1] + $movSpeed4[1] <= $borderB2[1]) {
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } elseif ($koordinat4[1] + $movSpeed4[1] < $borderA2[1]) {
                                $movSpeed4[1] = 0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            } else {
                                $movSpeed4[1] = -0.0002;
                                $koordinat4[1] = $koordinat4[1] + $movSpeed4[1];
                            }
                        }

                        if ($randFreqFishermanHighWave4 == 4 and $randHourFishermanHighWave4 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00002-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat4[0],
                        'longitude' => $koordinat4[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman4 * 3600 and $koordinat4[0] > $borderA2[0] and $koordinat4[1] > $borderA2[1]) {
                    if ($spareStat4 == 0) {
                        $spareStat4 = 1;
                        $xaa = abs($borderA2[0] - $koordinat4[0]);
                        $yaa = abs($borderA2[1] - $koordinat4[1]);
                        $movSpeed4[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed4[1] = $yaa / (1 * 3600 / $g);
                        $koordinat4[0] = $koordinat4[0] - $movSpeed4[0];
                        $koordinat4[1] = $koordinat4[1] - $movSpeed4[1];
                    } else {
                        $koordinat4[0] = $koordinat4[0] - $movSpeed4[0];
                        $koordinat4[1] = $koordinat4[1] - $movSpeed4[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00002-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat4[0],
                        'longitude' => $koordinat4[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman5 * 3600 and $j < $randFinishHourFisherman5 * 3600) {
                    if ($j == $randStartHourFisherman5 * 3600) {
                        $number = $number + 1;
                        $koordinat5 = [$borderA2[0], $borderA2[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish5 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat5 == 0) {
                            $fishermanStoptoFishRecStat5 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand5X = rand(-10, 10);
                        $rand5Y = rand(-10, 10);
                        $randX = $rand5X / 1000000;
                        $randY = $rand5Y / 1000000;
                        $movSpeed5[0] = $movSpeed5[0] + $randX;
                        $movSpeed5[1] = $movSpeed5[1] + $randY;
                        if ($movSpeed5[0] <= $maxMove and $movSpeed5[0] >= -1 * $maxMove) {
                            if ($koordinat5[0] + $movSpeed5[0] >= $borderA2[0] and $koordinat5[0] + $movSpeed5[0] <= $borderB2[0]) {
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } elseif ($koordinat5[0] + $movSpeed5[0] > $borderB2[0]) {
                                $movSpeed5[0] = -0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } else {
                                $movSpeed5[0] = 0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            }
                        } elseif ($movSpeed5[0] > $maxMove) {
                            $movSpeed5[0] = $maxMove;
                            if ($koordinat5[0] + $movSpeed5[0] >= $borderA2[0] and $koordinat5[0] + $movSpeed5[0] <= $borderB2[0]) {
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } elseif ($koordinat5[0] + $movSpeed5[0] > $borderB2[0]) {
                                $movSpeed5[0] = -0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } else {
                                $movSpeed5[0] = 0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            }
                        } else {
                            $movSpeed5[0] = -1 * $maxMove;
                            if ($koordinat5[0] + $movSpeed5[0] >= $borderA2[0] and $koordinat5[0] + $movSpeed5[0] <= $borderB2[0]) {
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } elseif ($koordinat5[0] + $movSpeed5[0] > $borderB2[0]) {
                                $movSpeed5[0] = -0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            } else {
                                $movSpeed5[0] = 0.0002;
                                $koordinat5[0] = $koordinat5[0] + $movSpeed5[0];
                            }
                        }

                        if ($movSpeed5[1] <= $maxMove and $movSpeed5[1] >= -1 * $maxMove) {
                            if ($koordinat5[1] + $movSpeed5[1] >= $borderA2[1] and $koordinat5[1] + $movSpeed5[1] <= $borderB2[1]) {
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } elseif ($koordinat5[1] + $movSpeed5[1] < $borderA2[1]) {
                                $movSpeed5[1] = 0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } else {
                                $movSpeed5[1] = -0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            }
                        } elseif ($movSpeed5[1] > $maxMove) {
                            $movSpeed5[1] = $maxMove;
                            if ($koordinat5[1] + $movSpeed5[1] >= $borderA2[1] and $koordinat5[1] + $movSpeed5[1] <= $borderB2[1]) {
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } elseif ($koordinat5[1] + $movSpeed5[1] < $borderA2[1]) {
                                $movSpeed5[1] = 0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } else {
                                $movSpeed5[1] = -0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            }
                        } else {
                            $movSpeed5[1] = -1 * $maxMove;
                            if ($koordinat5[1] + $movSpeed5[1] >= $borderA2[1] and $koordinat5[1] + $movSpeed5[1] <= $borderB2[1]) {
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } elseif ($koordinat5[1] + $movSpeed5[1] < $borderA2[1]) {
                                $movSpeed5[1] = 0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            } else {
                                $movSpeed5[1] = -0.0002;
                                $koordinat5[1] = $koordinat5[1] + $movSpeed5[1];
                            }
                        }

                        if ($randFreqFishermanHighWave5 == 4 and $randHourFishermanHighWave5 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00002-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat5[0],
                        'longitude' => $koordinat5[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman5 * 3600 and $koordinat5[0] > $borderA2[0] and $koordinat5[1] > $borderA2[1]) {
                    if ($spareStat5 == 0) {
                        $spareStat5 = 1;
                        $xaa = abs($borderA2[0] - $koordinat5[0]);
                        $yaa = abs($borderA2[1] - $koordinat5[1]);
                        $movSpeed5[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed5[1] = $yaa / (1 * 3600 / $g);
                        $koordinat5[0] = $koordinat5[0] - $movSpeed5[0];
                        $koordinat5[1] = $koordinat5[1] - $movSpeed5[1];
                    } else {
                        $koordinat5[0] = $koordinat5[0] - $movSpeed5[0];
                        $koordinat5[1] = $koordinat5[1] - $movSpeed5[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00002-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat5[0],
                        'longitude' => $koordinat5[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman6 * 3600 and $j < $randFinishHourFisherman6 * 3600) {
                    if ($j == $randStartHourFisherman6 * 3600) {
                        $number = $number + 1;
                        $koordinat6 = [$borderA3[0], $borderA3[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish6 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat6 == 0) {
                            $fishermanStoptoFishRecStat6 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand6X = rand(-10, 10);
                        $rand6Y = rand(-10, 10);
                        $randX = $rand6X / 1000000;
                        $randY = $rand6Y / 1000000;
                        $movSpeed6[0] = $movSpeed6[0] + $randX;
                        $movSpeed6[1] = $movSpeed6[1] + $randY;
                        if ($movSpeed6[0] <= $maxMove and $movSpeed6[0] >= -1 * $maxMove) {
                            if ($koordinat6[0] + $movSpeed6[0] >= $borderA3[0] and $koordinat6[0] + $movSpeed6[0] <= $borderB3[0]) {
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } elseif ($koordinat6[0] + $movSpeed6[0] > $borderB3[0]) {
                                $movSpeed6[0] = -0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } else {
                                $movSpeed6[0] = 0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            }
                        } elseif ($movSpeed6[0] > $maxMove) {
                            $movSpeed6[0] = $maxMove;
                            if ($koordinat6[0] + $movSpeed6[0] >= $borderA3[0] and $koordinat6[0] + $movSpeed6[0] <= $borderB3[0]) {
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } elseif ($koordinat6[0] + $movSpeed6[0] > $borderB3[0]) {
                                $movSpeed6[0] = -0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } else {
                                $movSpeed6[0] = 0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            }
                        } else {
                            $movSpeed6[0] = -1 * $maxMove;
                            if ($koordinat6[0] + $movSpeed6[0] >= $borderA3[0] and $koordinat6[0] + $movSpeed6[0] <= $borderB3[0]) {
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } elseif ($koordinat6[0] + $movSpeed6[0] > $borderB3[0]) {
                                $movSpeed6[0] = -0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            } else {
                                $movSpeed6[0] = 0.0002;
                                $koordinat6[0] = $koordinat6[0] + $movSpeed6[0];
                            }
                        }

                        if ($movSpeed6[1] <= $maxMove and $movSpeed6[1] >= -1 * $maxMove) {
                            if ($koordinat6[1] + $movSpeed6[1] >= $borderA3[1] and $koordinat6[1] + $movSpeed6[1] <= $borderB3[1]) {
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } elseif ($koordinat6[1] + $movSpeed6[1] < $borderA3[1]) {
                                $movSpeed6[1] = 0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } else {
                                $movSpeed6[1] = -0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            }
                        } elseif ($movSpeed6[1] > $maxMove) {
                            $movSpeed6[1] = $maxMove;
                            if ($koordinat6[1] + $movSpeed6[1] >= $borderA3[1] and $koordinat6[1] + $movSpeed6[1] <= $borderB3[1]) {
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } elseif ($koordinat6[1] + $movSpeed6[1] < $borderA3[1]) {
                                $movSpeed6[1] = 0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } else {
                                $movSpeed6[1] = -0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            }
                        } else {
                            $movSpeed6[1] = -1 * $maxMove;
                            if ($koordinat6[1] + $movSpeed6[1] >= $borderA3[1] and $koordinat6[1] + $movSpeed6[1] <= $borderB3[1]) {
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } elseif ($koordinat6[1] + $movSpeed6[1] < $borderA3[1]) {
                                $movSpeed6[1] = 0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            } else {
                                $movSpeed6[1] = -0.0002;
                                $koordinat6[1] = $koordinat6[1] + $movSpeed6[1];
                            }
                        }

                        if ($randFreqFishermanHighWave6 == 4 and $randHourFishermanHighWave6 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat6[0],
                        'longitude' => $koordinat6[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman6 * 3600 and $koordinat6[0] > $borderA3[0] and $koordinat6[1] > $borderA3[1]) {
                    if ($spareStat6 == 0) {
                        $spareStat6 = 1;
                        $xaa = abs($borderA3[0] - $koordinat6[0]);
                        $yaa = abs($borderA3[1] - $koordinat6[1]);
                        $movSpeed6[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed6[1] = $yaa / (1 * 3600 / $g);
                        $koordinat6[0] = $koordinat6[0] - $movSpeed6[0];
                        $koordinat6[1] = $koordinat6[1] - $movSpeed6[1];
                    } else {
                        $koordinat6[0] = $koordinat6[0] - $movSpeed6[0];
                        $koordinat6[1] = $koordinat6[1] - $movSpeed6[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00001',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat6[0],
                        'longitude' => $koordinat6[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman7 * 3600 and $j < $randFinishHourFisherman7 * 3600) {
                    if ($j == $randStartHourFisherman7 * 3600) {
                        $number = $number + 1;
                        $koordinat7 = [$borderA3[0], $borderA3[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish7 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat7 == 0) {
                            $fishermanStoptoFishRecStat7 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand7X = rand(-10, 10);
                        $rand7Y = rand(-10, 10);
                        $randX = $rand7X / 1000000;
                        $randY = $rand7Y / 1000000;
                        $movSpeed7[0] = $movSpeed7[0] + $randX;
                        $movSpeed7[1] = $movSpeed7[1] + $randY;
                        if ($movSpeed7[0] <= $maxMove and $movSpeed7[0] >= -1 * $maxMove) {
                            if ($koordinat7[0] + $movSpeed7[0] >= $borderA3[0] and $koordinat7[0] + $movSpeed7[0] <= $borderB3[0]) {
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } elseif ($koordinat7[0] + $movSpeed7[0] > $borderB3[0]) {
                                $movSpeed7[0] = -0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } else {
                                $movSpeed7[0] = 0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            }
                        } elseif ($movSpeed7[0] > $maxMove) {
                            $movSpeed7[0] = $maxMove;
                            if ($koordinat7[0] + $movSpeed7[0] >= $borderA3[0] and $koordinat7[0] + $movSpeed7[0] <= $borderB3[0]) {
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } elseif ($koordinat7[0] + $movSpeed7[0] > $borderB3[0]) {
                                $movSpeed7[0] = -0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } else {
                                $movSpeed7[0] = 0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            }
                        } else {
                            $movSpeed7[0] = -1 * $maxMove;
                            if ($koordinat7[0] + $movSpeed7[0] >= $borderA3[0] and $koordinat7[0] + $movSpeed7[0] <= $borderB3[0]) {
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } elseif ($koordinat7[0] + $movSpeed7[0] > $borderB3[0]) {
                                $movSpeed7[0] = -0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            } else {
                                $movSpeed7[0] = 0.0002;
                                $koordinat7[0] = $koordinat7[0] + $movSpeed7[0];
                            }
                        }

                        if ($movSpeed7[1] <= $maxMove and $movSpeed7[1] >= -1 * $maxMove) {
                            if ($koordinat7[1] + $movSpeed7[1] >= $borderA3[1] and $koordinat7[1] + $movSpeed7[1] <= $borderB3[1]) {
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } elseif ($koordinat7[1] + $movSpeed7[1] < $borderA3[1]) {
                                $movSpeed7[1] = 0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } else {
                                $movSpeed7[1] = -0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            }
                        } elseif ($movSpeed7[1] > $maxMove) {
                            $movSpeed7[1] = $maxMove;
                            if ($koordinat7[1] + $movSpeed7[1] >= $borderA3[1] and $koordinat7[1] + $movSpeed7[1] <= $borderB3[1]) {
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } elseif ($koordinat7[1] + $movSpeed7[1] < $borderA3[1]) {
                                $movSpeed7[1] = 0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } else {
                                $movSpeed7[1] = -0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            }
                        } else {
                            $movSpeed7[1] = -1 * $maxMove;
                            if ($koordinat7[1] + $movSpeed7[1] >= $borderA3[1] and $koordinat7[1] + $movSpeed7[1] <= $borderB3[1]) {
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } elseif ($koordinat7[1] + $movSpeed7[1] < $borderA3[1]) {
                                $movSpeed7[1] = 0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            } else {
                                $movSpeed7[1] = -0.0002;
                                $koordinat7[1] = $koordinat7[1] + $movSpeed7[1];
                            }
                        }

                        if ($randFreqFishermanHighWave7 == 4 and $randHourFishermanHighWave7 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat7[0],
                        'longitude' => $koordinat7[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman7 * 3600 and $koordinat7[0] > $borderA3[0] and $koordinat7[1] > $borderA3[1]) {
                    if ($spareStat7 == 0) {
                        $spareStat7 = 1;
                        $xaa = abs($borderA3[0] - $koordinat7[0]);
                        $yaa = abs($borderA3[1] - $koordinat7[1]);
                        $movSpeed7[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed7[1] = $yaa / (1 * 3600 / $g);
                        $koordinat7[0] = $koordinat7[0] - $movSpeed7[0];
                        $koordinat7[1] = $koordinat7[1] - $movSpeed7[1];
                    } else {
                        $koordinat7[0] = $koordinat7[0] - $movSpeed7[0];
                        $koordinat7[1] = $koordinat7[1] - $movSpeed7[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00002',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat7[0],
                        'longitude' => $koordinat7[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman8 * 3600 and $j < $randFinishHourFisherman8 * 3600) {
                    if ($j == $randStartHourFisherman8 * 3600) {
                        $number = $number + 1;
                        $koordinat8 = [$borderA3[0], $borderA3[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish8 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat8 == 0) {
                            $fishermanStoptoFishRecStat8 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand8X = rand(-10, 10);
                        $rand8Y = rand(-10, 10);
                        $randX = $rand8X / 1000000;
                        $randY = $rand8Y / 1000000;
                        $movSpeed8[0] = $movSpeed8[0] + $randX;
                        $movSpeed8[1] = $movSpeed8[1] + $randY;
                        if ($movSpeed8[0] <= $maxMove and $movSpeed8[0] >= -1 * $maxMove) {
                            if ($koordinat8[0] + $movSpeed8[0] >= $borderA3[0] and $koordinat8[0] + $movSpeed8[0] <= $borderB3[0]) {
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } elseif ($koordinat8[0] + $movSpeed8[0] > $borderB3[0]) {
                                $movSpeed8[0] = -0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } else {
                                $movSpeed8[0] = 0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            }
                        } elseif ($movSpeed8[0] > $maxMove) {
                            $movSpeed8[0] = $maxMove;
                            if ($koordinat8[0] + $movSpeed8[0] >= $borderA3[0] and $koordinat8[0] + $movSpeed8[0] <= $borderB3[0]) {
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } elseif ($koordinat8[0] + $movSpeed8[0] > $borderB3[0]) {
                                $movSpeed8[0] = -0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } else {
                                $movSpeed8[0] = 0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            }
                        } else {
                            $movSpeed8[0] = -1 * $maxMove;
                            if ($koordinat8[0] + $movSpeed8[0] >= $borderA3[0] and $koordinat8[0] + $movSpeed8[0] <= $borderB3[0]) {
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } elseif ($koordinat8[0] + $movSpeed8[0] > $borderB3[0]) {
                                $movSpeed8[0] = -0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            } else {
                                $movSpeed8[0] = 0.0002;
                                $koordinat8[0] = $koordinat8[0] + $movSpeed8[0];
                            }
                        }

                        if ($movSpeed8[1] <= $maxMove and $movSpeed8[1] >= -1 * $maxMove) {
                            if ($koordinat8[1] + $movSpeed8[1] >= $borderA3[1] and $koordinat8[1] + $movSpeed8[1] <= $borderB3[1]) {
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } elseif ($koordinat8[1] + $movSpeed8[1] < $borderA3[1]) {
                                $movSpeed8[1] = 0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } else {
                                $movSpeed8[1] = -0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            }
                        } elseif ($movSpeed8[1] > $maxMove) {
                            $movSpeed8[1] = $maxMove;
                            if ($koordinat8[1] + $movSpeed8[1] >= $borderA3[1] and $koordinat8[1] + $movSpeed8[1] <= $borderB3[1]) {
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } elseif ($koordinat8[1] + $movSpeed8[1] < $borderA3[1]) {
                                $movSpeed8[1] = 0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } else {
                                $movSpeed8[1] = -0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            }
                        } else {
                            $movSpeed8[1] = -1 * $maxMove;
                            if ($koordinat8[1] + $movSpeed8[1] >= $borderA3[1] and $koordinat8[1] + $movSpeed8[1] <= $borderB3[1]) {
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } elseif ($koordinat8[1] + $movSpeed8[1] < $borderA3[1]) {
                                $movSpeed8[1] = 0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            } else {
                                $movSpeed8[1] = -0.0002;
                                $koordinat8[1] = $koordinat8[1] + $movSpeed8[1];
                            }
                        }

                        if ($randFreqFishermanHighWave8 == 4 and $randHourFishermanHighWave8 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00003',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat8[0],
                        'longitude' => $koordinat8[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman8 * 3600 and $koordinat8[0] > $borderA3[0] and $koordinat8[1] > $borderA3[1]) {
                    if ($spareStat8 == 0) {
                        $spareStat8 = 1;
                        $xaa = abs($borderA3[0] - $koordinat8[0]);
                        $yaa = abs($borderA3[1] - $koordinat8[1]);
                        $movSpeed8[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed8[1] = $yaa / (1 * 3600 / $g);
                        $koordinat8[0] = $koordinat8[0] - $movSpeed8[0];
                        $koordinat8[1] = $koordinat8[1] - $movSpeed8[1];
                    } else {
                        $koordinat8[0] = $koordinat8[0] - $movSpeed8[0];
                        $koordinat8[1] = $koordinat8[1] - $movSpeed8[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00003',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat8[0],
                        'longitude' => $koordinat8[1],
                        'stat' => $stat
                    ];
                }

                if ($j >= $randStartHourFisherman9 * 3600 and $j < $randFinishHourFisherman9 * 3600) {
                    if ($j == $randStartHourFisherman9 * 3600) {
                        $number = $number + 1;
                        $koordinat9 = [$borderA3[0], $borderA3[1]];
                        $stat = 0;
                    } elseif ($j >= $randHourFishermanStoptoFish9 * 3600) {
                        $number = $number + 1;
                        $stat = 0;
                        if ($fishermanStoptoFishRecStat9 == 0) {
                            $fishermanStoptoFishRecStat9 = 1;
                            $stat = 1;
                        }
                    } else {
                        $number = $number + 1;
                        $rand9X = rand(-10, 10);
                        $rand9Y = rand(-10, 10);
                        $randX = $rand9X / 1000000;
                        $randY = $rand9Y / 1000000;
                        $movSpeed9[0] = $movSpeed9[0] + $randX;
                        $movSpeed9[1] = $movSpeed9[1] + $randY;
                        if ($movSpeed9[0] <= $maxMove and $movSpeed9[0] >= -1 * $maxMove) {
                            if ($koordinat9[0] + $movSpeed9[0] >= $borderA3[0] and $koordinat9[0] + $movSpeed9[0] <= $borderB3[0]) {
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } elseif ($koordinat9[0] + $movSpeed9[0] > $borderB3[0]) {
                                $movSpeed9[0] = -0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } else {
                                $movSpeed9[0] = 0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            }
                        } elseif ($movSpeed9[0] > $maxMove) {
                            $movSpeed9[0] = $maxMove;
                            if ($koordinat9[0] + $movSpeed9[0] >= $borderA3[0] and $koordinat9[0] + $movSpeed9[0] <= $borderB3[0]) {
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } elseif ($koordinat9[0] + $movSpeed9[0] > $borderB3[0]) {
                                $movSpeed9[0] = -0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } else {
                                $movSpeed9[0] = 0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            }
                        } else {
                            $movSpeed9[0] = -1 * $maxMove;
                            if ($koordinat9[0] + $movSpeed9[0] >= $borderA3[0] and $koordinat9[0] + $movSpeed9[0] <= $borderB3[0]) {
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } elseif ($koordinat9[0] + $movSpeed9[0] > $borderB3[0]) {
                                $movSpeed9[0] = -0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            } else {
                                $movSpeed9[0] = 0.0002;
                                $koordinat9[0] = $koordinat9[0] + $movSpeed9[0];
                            }
                        }

                        if ($movSpeed9[1] <= $maxMove and $movSpeed9[1] >= -1 * $maxMove) {
                            if ($koordinat9[1] + $movSpeed9[1] >= $borderA3[1] and $koordinat9[1] + $movSpeed9[1] <= $borderB3[1]) {
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } elseif ($koordinat9[1] + $movSpeed9[1] < $borderA3[1]) {
                                $movSpeed9[1] = 0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } else {
                                $movSpeed9[1] = -0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            }
                        } elseif ($movSpeed9[1] > $maxMove) {
                            $movSpeed9[1] = $maxMove;
                            if ($koordinat9[1] + $movSpeed9[1] >= $borderA3[1] and $koordinat9[1] + $movSpeed9[1] <= $borderB3[1]) {
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } elseif ($koordinat9[1] + $movSpeed9[1] < $borderA3[1]) {
                                $movSpeed9[1] = 0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } else {
                                $movSpeed9[1] = -0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            }
                        } else {
                            $movSpeed9[1] = -1 * $maxMove;
                            if ($koordinat9[1] + $movSpeed9[1] >= $borderA3[1] and $koordinat9[1] + $movSpeed9[1] <= $borderB3[1]) {
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } elseif ($koordinat9[1] + $movSpeed9[1] < $borderA3[1]) {
                                $movSpeed9[1] = 0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            } else {
                                $movSpeed9[1] = -0.0002;
                                $koordinat9[1] = $koordinat9[1] + $movSpeed9[1];
                            }
                        }

                        if ($randFreqFishermanHighWave9 == 4 and $randHourFishermanHighWave9 == $hour and $minute == 0 and $sec == 0) {
                            $stat = 2;
                        } else {
                            $stat = 0;
                        }
                    }

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00004',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat9[0],
                        'longitude' => $koordinat9[1],
                        'stat' => $stat
                    ];
                } elseif ($j > $randFinishHourFisherman9 * 3600 and $koordinat9[0] > $borderA3[0] and $koordinat9[1] > $borderA3[1]) {
                    if ($spareStat9 == 0) {
                        $spareStat9 = 1;
                        $xaa = abs($borderA3[0] - $koordinat9[0]);
                        $yaa = abs($borderA3[1] - $koordinat9[1]);
                        $movSpeed9[0] = $xaa / (1 * 3600 / $g);
                        $movSpeed9[1] = $yaa / (1 * 3600 / $g);
                        $koordinat9[0] = $koordinat9[0] - $movSpeed9[0];
                        $koordinat9[1] = $koordinat9[1] - $movSpeed9[1];
                    } else {
                        $koordinat9[0] = $koordinat9[0] - $movSpeed9[0];
                        $koordinat9[1] = $koordinat9[1] - $movSpeed9[1];
                    }

                    $stat = 0;
                    $number = $number + 1;

                    $data[$number - 1] = [
                        'id' => $number,
                        'fisherman_id' => '00003-00004',
                        'date' => $thisDate,
                        'time' => $time,
                        'latitude' => $koordinat9[0],
                        'longitude' => $koordinat9[1],
                        'stat' => $stat
                    ];
                }
            }
        }

        // Using Query Builder
        $this->db->table('all_data')->insertBatch($data);
    }
}
