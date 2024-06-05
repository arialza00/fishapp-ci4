<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class InfoData extends Migration
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
            'start_time'       => [
                'type'    => 'DATETIME',
            ],
            'finish_time'       => [
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
                'type'           => 'DOUBLE',
            ],
            'radius'      => [
                'type'           => 'DOUBLE',
            ],
            'delete_stat'      => [
                'type'    => 'TINYINT',
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel users
        $this->forge->createTable('info_data', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('info_data');
    }
}
