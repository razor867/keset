<?php

namespace App\Controllers;

use App\Models\M_Asset_types;
use App\Models\M_Assets;
use Irsyadulibad\DataTables\DataTables;

class Assets extends BaseController
{
    protected $validation;
    protected $m_asset_types;
    protected $m_asset;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->m_asset_types = new M_Asset_types();
        $this->m_asset = new M_Assets();
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

    public function form_main_assets($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Main Assets';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' main asset';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' main asset';
        $data['menu'] = 'assets';
        $data['submenu'] = 'main_assets';
        $data['back_url'] = base_url('assets/main_assets');
        $data['action_url'] = base_url('assets/save_main_assets');
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $data['asset_types'] = $this->m_asset_types->findAll();
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_asset->find($id);
                if ($exist) {
                    $data['name'] = $exist->name;
                    $data['detail'] = $exist->detail;
                    $data['total'] = $exist->total;
                    $data['price'] = $exist->price;
                    $asset_type = $this->m_asset_types->find($exist->type_asset);
                    $data['asset_type_name_edit'] = $asset_type->name;
                    $data['asset_type_id_edit'] = $asset_type->id;
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
            return view('assets/form_main_assets', $data);
        }
    }

    public function form_consumables($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Consumables';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' consumables';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' consumables';
        $data['menu'] = 'assets';
        $data['submenu'] = 'consumables';
        $data['back_url'] = base_url('assets/consumables');
        $data['action_url'] = base_url('assets/save_consumables');
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $data['asset_types'] = $this->m_asset_types->findAll();
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_asset->find($id);
                if ($exist) {
                    $data['name'] = $exist->name;
                    $data['detail'] = $exist->detail;
                    $data['qty'] = $exist->qty;
                    $data['price'] = $exist->price;
                    $asset_type = $this->m_asset_types->find($exist->type_asset);
                    $data['asset_type_name_edit'] = $asset_type->name;
                    $data['asset_type_id_edit'] = $asset_type->id;
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
            return view('assets/form_consumables', $data);
        }
    }

    public function save_main_assets($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('main_assets'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('assets/form_main_assets/' . (empty($id) ? '' : $id)))->withInput();
        }

        $postData = $this->request->getPost();
        $err = false;
        $asset_id = $postData['main_assets_id'];
        $postData['category'] = 'main_assets';
        $postData['qty'] = 0;
        if (!empty($asset_id)) {
            if (is_numeric($asset_id)) {
                $exist = $this->m_asset->find($asset_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_asset->update($asset_id, $postData);
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
                $this->m_asset->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('assets/main_assets'));
        }
    }

    public function save_consumables($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('consumables'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('assets/form_consumables/' . (empty($id) ? '' : $id)))->withInput();
        }

        $postData = $this->request->getPost();
        $err = false;
        $asset_id = $postData['consumables_id'];
        $postData['category'] = 'consumables';
        $postData['total'] = 0;
        if (!empty($asset_id)) {
            if (is_numeric($asset_id)) {
                $exist = $this->m_asset->find($asset_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_asset->update($asset_id, $postData);
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
                $this->m_asset->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('assets/consumables'));
        }
    }

    public function listdata_main_assets()
    {
        return DataTables::use('asset')
            ->where(['asset.deleted_at' => NULL, 'asset.category' => 'main_assets'])
            ->select('asset.name as asset_name, detail, total, price, asset.id as id_asset, asset_type.name as type_name')
            ->join('asset_type', 'asset.type_asset = asset_type.id', 'LEFT JOIN')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('assets/form_main_assets/' . $data->id_asset) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_main_assets\',\'' . $data->id_asset . '\')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>';

                return $button_action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function listdata_consumables()
    {
        return DataTables::use('asset')
            ->where(['asset.deleted_at' => NULL, 'asset.category' => 'consumables'])
            ->select('asset.name as consumable_name, detail, qty, price, asset.id as id_asset, asset_type.name as type_name')
            ->join('asset_type', 'asset.type_asset = asset_type.id', 'LEFT JOIN')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('assets/form_consumables/' . $data->id_asset) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_consumables\',\'' . $data->id_asset . '\')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>';

                return $button_action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete_main_assets($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_asset->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_asset->update($id, $data);
                    $this->m_asset->delete($id);
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
            return redirect()->to(base_url('assets/main_assets'));
        }
    }

    public function delete_consumables($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_asset->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_asset->update($id, $data);
                    $this->m_asset->delete($id);
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
            return redirect()->to(base_url('assets/consumables'));
        }
    }
}
