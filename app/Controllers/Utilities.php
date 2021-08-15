<?php

namespace App\Controllers;

use App\Models\M_Asset_types;
use Irsyadulibad\DataTables\DataTables;

class Utilities extends BaseController
{
    protected $validation;
    protected $m_asset_types;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->m_asset_types = new M_Asset_types();
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

    public function listdata_asset_types()
    {
        return DataTables::use('asset_type')
            ->where(['deleted_at' => NULL])
            ->select('name, id')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('utilities/form_asset_types/' . $data->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_asset_types\',\'' . $data->id . '\')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>';
                return $button_action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function form_asset_types($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Asset Types';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' tipe aset';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' tipe aset';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_asset_types';
        $data['back_url'] = base_url('utilities/asset_types');
        $data['action_url'] = (empty($id)) ? base_url('utilities/save_asset_types') : base_url('utilities/save_asset_types/' . $id);
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_asset_types->find($id);
                if ($exist) {
                    $data['name'] = $exist->name;
                } else {
                    $err = true;
                }
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return view('utilities/form/form_asset_types', $data);
        }
    }

    public function save_asset_types($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('asset_types'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('utilities/form_asset_types/' . (empty($id) ? '' : $id)))->withInput();
        }
        $postData = $this->request->getPost();
        $err = false;
        $asset_id = $postData['asset_types_id'];
        if (!empty($asset_id)) {
            if (is_numeric($asset_id)) {
                $exist = $this->m_asset_types->find($asset_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_asset_types->update($asset_id, $postData);
                    session()->setFlashdata('info', 'success_edit');
                } else {
                    session()->setFlashdata('info', 'error_edit');
                }
            } else {
                $err = true;
            }
        } else {
            if (is_numeric($asset_id)) {
                $postData['created_by'] = user_id();
                $this->m_asset_types->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/asset_types'));
        }
    }

    public function delete_asset_types($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_asset_types->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_asset_types->update($id, $data);
                    $this->m_asset_types->delete($id);
                    session()->setFlashdata('info', 'success_delete');
                } else {
                    session()->setFlashdata('info', 'error_delete');
                }
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/asset_types'));
        }
    }
}
