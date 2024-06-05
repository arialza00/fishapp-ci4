<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AllData extends Migration
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
            'fisherman_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 11
            ], 
            'timestamp'      => [
                'type'    => 'DATETIME',
            ], 
            'latitude'      => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
            ], 
            'longitude'      => [
                'type' => 'DECIMAL',
                'constraint' => '10,5',
            ], 
            'stat'      => [
                'type'           => 'TINYINT'
            ]
        ]);


        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel users
        $this->forge->createTable('all_data', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('all_data');
    }
}
