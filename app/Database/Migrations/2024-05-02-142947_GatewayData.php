<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GatewayData extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'gateway_id'          => [
                'type'           => 'INT(5) ZEROFILL',
                'unsigned'       => true
            ], 
            'gateway_name'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ], 
            'api_key'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ], 
            'latitude'      => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
            ], 
            'longitude'      => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
            ],
            'delete_stat'      => [
                'type'    => 'TINYINT',
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel users
        $this->forge->createTable('gateway_data', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('gateway_data');
    }
}
