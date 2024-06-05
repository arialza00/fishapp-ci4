<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class fishermanSeeder extends Seeder
{
    public function run()
    {
        $arrayName = array('Mohamad Bimo Willyanda', 'Nauval Sakinah', 'Aggil Indriastari', 'Ressy Forsa', 'Yuda Hidayatullah', 'Arthur Shabrina', 'Indra Rikzan', 'Ilham Adha', 'Aufa Fiora', 'Ari Ariani', 'Jeremiah Hidayat', 'Yenu Widyaningtias', 'Rutwan Prabowo', 'Banni Devito Daming', 'Emir Anindya', 'Sigit Marza Hilmiansyah', 'Jhon Anantarqi', 'Devito Hayati', 'Ferdiansyah Edwin Aprisilia', 'Firdaus Laurensia');

        $number = 0;
        $gatewayId = array("00001", "00002", "00003");
        $numberArr = array(0, 0, 0);
        $data = array(array());

        foreach ($arrayName as $arrayName) {
            $number = $number + 1;
            $d = array_rand($gatewayId, 1);
            $numberArr[$d] = $numberArr[$d] + 1;
            $random_gateway = $gatewayId[$d];
            $a = $numberArr[$d] + 100000;
            $b = (string)$a;
            $c = substr($b, 1);
            $data[$number - 1] = [
                'id' => $number,
                'fisherman_gateway' => $random_gateway,
                'fisherman_id' => $random_gateway . '-' . $c,
                'fisherman_name' => $arrayName,
                'delete_stat' => 0
            ];
        }

        // Using Query Builder
        $this->db->table('fisherman_data')->insertBatch($data);
    }
}
