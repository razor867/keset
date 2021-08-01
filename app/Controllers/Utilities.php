<?php

namespace App\Controllers;

class Utilities extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->to(base_url('utilities/asset_types'));
    }

    public function asset_types()
    {
        $data['title_page'] = 'Asset Types';
        $data['content'] = 'Data tipe aset';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_asset_types';
        return view('utilities/asset_types', $data);
    }

    public function asset_purchase()
    {
        $data['title_page'] = 'Asset Purchase';
        $data['content'] = 'Data pembelian aset';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_asset_purchase';
        return view('utilities/asset_purchase', $data);
    }

    public function employees()
    {
        $data['title_page'] = 'Employees';
        $data['content'] = 'Data karyawan';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_employees';
        return view('utilities/employees', $data);
    }

    public function positions()
    {
        $data['title_page'] = 'Positions';
        $data['content'] = 'Data karyawan';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_positions';
        return view('utilities/positions', $data);
    }

    public function departments()
    {
        $data['title_page'] = 'Departments';
        $data['content'] = 'Data karyawan';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_departments';
        return view('utilities/departments', $data);
    }
}
