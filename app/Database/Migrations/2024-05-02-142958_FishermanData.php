<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FishermanData extends Migration
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
            'fisherman_gateway'      => [
                'type'           => 'INT(5) ZEROFILL',
                'unsigned'       => true
            ],
            'fisherman_id'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 11
            ],
            'fisherman_name'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'delete_stat'      => [
                'type'    => 'TINYINT',
            ],
            'last_record'      => [
                'type'           => 'TIMESTAMP'
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel users
        $this->forge->createTable('fisherman_data', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('fisherman_data');
    }
}
