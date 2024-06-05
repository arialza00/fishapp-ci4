<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
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
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'default'        => 'John Doe',
            ],
            'email'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'role'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            // 'created_at' => [
            //     'type'    => 'TIMESTAMP',
            //     'default' => new RawSql('CURRENT_TIMESTAMP'),
            // ],
        ]);

        // Membuat primary key
        $this->forge->addKey('id', TRUE);

        // Membuat tabel users
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
