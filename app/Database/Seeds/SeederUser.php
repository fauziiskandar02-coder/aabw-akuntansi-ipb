<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederUser extends Seeder
{
    public function run()
    {
        // 1. Groups
        $groups = [
            ['id' => 1, 'name' => 'admin', 'description' => 'Pengelola Sistem'],
            ['id' => 2, 'name' => 'user', 'description' => 'Pengguna Umum'],
        ];
        $this->db->table('auth_groups')->insertBatch($groups);

        // 2. Users
        $users = [
            [
                'email'         => 'admin@aabw.com',
                'username'      => 'admin',
                'fullname'      => 'Administrator Utama',
                'user_img'      => 'avatar-1.png',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'email'         => 'fauzi@ipb.ac.id',
                'username'      => 'fauzi',
                'fullname'      => 'Fauzi Iskandar',
                'user_img'      => 'avatar-1.png',
                'password_hash' => password_hash('fauzi123', PASSWORD_BCRYPT),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'email'         => 'najwan@gmail.com',
                'username'      => 'najwan',
                'fullname'      => 'Najwan Pratama',
                'user_img'      => 'avatar-2.png',
                'password_hash' => password_hash('user123', PASSWORD_BCRYPT),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $u) {
            $this->db->table('users')->insert($u);
            $userId = $this->db->insertID();
            $groupId = ($u['username'] == 'najwan') ? 2 : 1;
            $this->db->table('auth_groups_users')->insert([
                'group_id' => $groupId,
                'user_id'  => $userId,
            ]);
        }
    }
}
