<?php

namespace App\Controllers;

use Faker\Provider\Base;

class Users extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['title_page'] = 'Users';
        $data['content'] = 'Data akun yang menggunakan aplikasi';
        $data['menu'] = 'users';
        $data['submenu'] = '';
        return view('users/users', $data);
    }
}
