<?php

namespace App\Database\Seeds;

class InfoDataSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'start_time' => '2023-07-23 20:23:32',
                'finish_time' => '2026-01-03 22:12:38',
                'latitude' => '-4,405',
                'longitude' => '107,771',
                'stat' => 2,
                'radius' => 2,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-08-09 19:12:40',
                'finish_time' => '2025-10-11 04:35:16',
                'latitude' => '-4,949',
                'longitude' => '114,075',
                'stat' => 1,
                'radius' => 3,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-09 01:11:45',
                'finish_time' => '2026-06-18 22:59:3',
                'latitude' => '-5,823',
                'longitude' => '109,541',
                'stat' => 2,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-28 18:03:46',
                'finish_time' => '2025-10-21 20:54:49',
                'latitude' => '-6,366',
                'longitude' => '114,290',
                'stat' => 3,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-27 15:47:04',
                'finish_time' => '2026-03-05 07:31:32',
                'latitude' => '-5,575',
                'longitude' => '118,388',
                'stat' => 3,
                'radius' => 4,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-24 13:45:15',
                'finish_time' => '2026-03-13 12:33:32',
                'latitude' => '-6,891',
                'longitude' => '116,177',
                'stat' => 3,
                'radius' => 1,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-12 20:14:04',
                'finish_time' => '2026-03-04 01:11:33',
                'latitude' => '-5,125',
                'longitude' => '103,347',
                'stat' => 2,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-20 19:54:50',
                'finish_time' => '2026-06-15 05:28:11',
                'latitude' => '-2,692',
                'longitude' => '100,729',
                'stat' => 1,
                'radius' => 4,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-08-10 10:38:44',
                'finish_time' => '2026-01-23 20:21:47',
                'latitude' => '-3,734',
                'longitude' => '107,457',
                'stat' => 3,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-08-13 13:51:55',
                'finish_time' => '2025-08-09 06:47:21',
                'latitude' => '-5,00',
                'longitude' => '117,00',
                'stat' => 1,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-29 21:01:22',
                'finish_time' => '2026-02-09 23:31:34',
                'latitude' => '-6,00',
                'longitude' => '111,00',
                'stat' => 3,
                'radius' => 1,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-26 13:37:54',
                'finish_time' => '2025-09-29 04:16:25',
                'latitude' => '-6,00',
                'longitude' => '116,00',
                'stat' => 3,
                'radius' => 1,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-22 21:17:57',
                'finish_time' => '2025-11-15 21:36:40',
                'latitude' => '-5,00',
                'longitude' => '117,00',
                'stat' => 1,
                'radius' => 4,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-09 15:27:50',
                'finish_time' => '2026-08-07 12:18:21',
                'latitude' => '-3,00',
                'longitude' => '109,00',
                'stat' => 3,
                'radius' => 1,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-19 15:50:26',
                'finish_time' => '2025-08-22 11:02:9',
                'latitude' => '-6,00',
                'longitude' => '113,00',
                'stat' => 3,
                'radius' => 5,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-05 21:53:00',
                'finish_time' => '2025-10-22 22:09:1',
                'latitude' => '-4,00',
                'longitude' => '114,00',
                'stat' => 1,
                'radius' => 1,
                'delete_stat' => 0
            ],
            [
                'start_time' => '2023-07-03 19:45:34',
                'finish_time' => '2025-11-09 04:30:21',
                'latitude' => '-6,00',
                'longitude' => '111,00',
                'stat' => 2,
                'radius' => 2,
                'delete_stat' => 0
            ]
        ];
        $this->db->table('info_data')->insertBatch($data);
    }
}