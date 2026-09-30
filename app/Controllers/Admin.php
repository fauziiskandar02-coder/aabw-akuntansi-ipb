<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('users');
        $builder->select('users.id as userid, username, email, fullname, user_img, auth_groups.name as role');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left');
        $query = $builder->get();

        $data['users'] = $query->getResult();
        return view('admin/index', $data);
    }

    public function detail($id = null)
    {
        $builder = $this->db->table('users');
        $builder->select('users.id as userid, username, email, fullname, user_img, auth_groups.name as role');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left');
        $builder->where('users.id', $id);
        $query = $builder->get();

        $user = $query->getRow();
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['user'] = $user;
        return view('admin/detail', $data);
    }
}
