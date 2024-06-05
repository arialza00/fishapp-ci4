<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name'  => 'admin',
                'email'  => 'admin@email.com',
                'password'  =>  password_hash('admin',PASSWORD_DEFAULT),
                'role'  => 'admin',
            ],
            [
                'name'  => 'user',
                'email'  => 'user@email.com',
                'password'  =>  password_hash('user',PASSWORD_DEFAULT),
                'role'  => 'user',
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}