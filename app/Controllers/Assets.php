<?php

namespace App\Controllers;

class Assets extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->to(base_url('assets/main_assets'));
    }

    public function main_assets()
    {
        $data['title_page'] = 'Main Assets';
        $data['content'] = 'Data aset utama yang dimiliki perusahaan';
        $data['menu'] = 'assets';
        $data['submenu'] = 'main_assets';
        return view('assets/main_assets', $data);
    }

    public function consumables()
    {
        $data['title_page'] = 'Consumables';
        $data['content'] = 'Data aset habis pakai yang dimiliki perusahaan';
        $data['menu'] = 'assets';
        $data['submenu'] = 'consumables';
        return view('assets/consumables', $data);
    }
}
