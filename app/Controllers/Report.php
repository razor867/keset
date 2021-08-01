<?php

namespace App\Controllers;

class Report extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->to(base_url('report/usable_assets'));
    }

    public function usable_assets()
    {
        $data['title_page'] = 'Usable Assets';
        $data['content'] = 'Data aset yang sedang dipinjamkan';
        $data['menu'] = 'report_data';
        $data['submenu'] = 'report_data_usable_assets';
        return view('report/usable_assets', $data);
    }

    public function repair_assets()
    {
        $data['title_page'] = 'Repair Assets';
        $data['content'] = 'Data aset yang sedang diperbaiki';
        $data['menu'] = 'report_data';
        $data['submenu'] = 'report_data_repair_assets';
        return view('report/repair_assets', $data);
    }

    public function broken_assets()
    {
        $data['title_page'] = 'Broken Assets';
        $data['content'] = 'Data aset yang rusak';
        $data['menu'] = 'report_data';
        $data['submenu'] = 'report_data_broken_assets';
        return view('report/broken_assets', $data);
    }

    public function lost_assets()
    {
        $data['title_page'] = 'Lost Assets';
        $data['content'] = 'Data aset yang hilang';
        $data['menu'] = 'report_data';
        $data['submenu'] = 'report_data_lost_assets';
        return view('report/lost_assets', $data);
    }
}
