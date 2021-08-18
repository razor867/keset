<?php

namespace App\Controllers;

use App\Models\M_Asset_purchase;
use App\Models\M_Asset_types;
use App\Models\M_Assets;
use Irsyadulibad\DataTables\DataTables;

class Utilities extends BaseController
{
    protected $validation;
    protected $m_asset_types;
    protected $m_assets;
    protected $m_purchase;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->m_asset_types = new M_Asset_types();
        $this->m_assets = new M_Assets();
        $this->m_purchase = new M_Asset_purchase();
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

    public function listdata_asset_purchase()
    {
        return DataTables::use('purchase')
            ->where(['purchase.deleted_at' => NULL])
            ->select('asset.name as asset_name, purchase.total as purchase_total, purchase.price as purchase_price, purchase.total_price as purchase_total_price, seller, date, purchase.id as purchase_id')
            ->join('asset', 'purchase.asset_id = asset.id', 'LEFT JOIN')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('utilities/form_asset_purchase/' . $data->purchase_id) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_asset_purchase\',\'' . $data->purchase_id . '\')" title="Delete">
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
        $data['action_url'] = base_url('utilities/save_asset_types/' . (empty($id) ? '' : $id));
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

    public function form_asset_purchase($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Asset Purchase';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' data pembelian aset';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' data pembelian aset';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_asset_purchase';
        $data['back_url'] = base_url('utilities/asset_purchase');
        $data['action_url'] = base_url('utilities/save_asset_purchase/' . (empty($id) ? '' : $id));
        // $data['assets'] = $this->m_assets->findAll();
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_purchase->find($id);
                if ($exist) {
                    $asset = $this->m_assets->find($exist->asset_id);

                    $data['asset_id_edit'] = $exist->asset_id;
                    $data['asset_name_edit'] = $asset->name;
                    $data['total'] = $exist->total;
                    $data['price'] = $exist->price;
                    $data['total_price'] = $exist->total_price;
                    $data['seller'] = $exist->seller;
                    $data['date'] = $exist->date;
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
            return view('utilities/form/form_asset_purchase', $data);
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

    public function save_asset_purchase($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('asset_purchase'))) {
            session()->setFlashdata('info', (empty($id)) ?: 'error_edit');
            return redirect()->to(base_url('utilities/form_asset_purchase/' . (empty($id) ? '' : $id)))->withInput();
        }
        $postData = $this->request->getPost();
        $err = false;
        $asset_purchase_id = $postData['asset_purchase_id'];
        if (!empty($asset_purchase_id)) {
            if (is_numeric($asset_purchase_id)) {
                $exist = $this->m_purchase->find($asset_purchase_id);
                if ($exist) {
                    $asset = $this->m_assets->find($exist->asset_id);
                    $asset_category = $asset->category;
                    $postData['updated_by'] = user_id();
                    $newTotal = $postData['total'];
                    $currentlyTotalAsset = ($asset_category == 'main_assets') ? $asset->total : $asset->qty;
                    $currentlyTotalAssetPurchase = $exist->total;

                    if ($currentlyTotalAssetPurchase != $newTotal) {
                        if ($currentlyTotalAssetPurchase < $newTotal) {
                            //tambah
                            $selisih = $newTotal - $currentlyTotalAssetPurchase;
                            $newTotalForAsset = $currentlyTotalAsset + $selisih;
                        } else {
                            //kurang
                            $selisih = $currentlyTotalAssetPurchase - $newTotal;
                            $newTotalForAsset = $currentlyTotalAsset - $selisih;
                        }

                        if ($asset_category == 'main_assets') {
                            $this->m_assets->update($postData['asset_id'], ['total' => $newTotalForAsset, 'updated_by' => $postData['updated_by']]);
                        } else {
                            $this->m_assets->update($postData['asset_id'], ['qty' => $newTotalForAsset, 'updated_by' => $postData['updated_by']]);
                        }
                    }
                    $this->m_purchase->update($asset_purchase_id, $postData);
                    session()->setFlashdata('info', 'success_edit');
                } else {
                    session()->setFlashdata('info', 'error_edit');
                }
            } else {
                $err = true;
            }
        } else {
            if (is_numeric($asset_purchase_id)) {
                $postData['created_by'] = user_id();
                $asset = $this->m_assets->find($postData['asset_id']);
                $currentlyTotalAsset = ($asset->category == 'main_assets') ? $asset->total : $asset->qty;
                $newTotal = $currentlyTotalAsset + $postData['total'];
                if ($asset->category == 'main_assets') {
                    $this->m_assets->update($postData['asset_id'], ['total' => $newTotal, 'updated_by' => user_id()]);
                } else {
                    $this->m_assets->update($postData['asset_id'], ['qty' => $newTotal, 'updated_by' => user_id()]);
                }
                $this->m_purchase->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/asset_purchase'));
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

    public function delete_asset_purchase($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_purchase->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_purchase->update($id, $data);
                    $this->m_purchase->delete($id);
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
            return redirect()->to(base_url('utilities/asset_purchase'));
        }
    }

    public function get_ajax_asset()
    {
        $this->request->isAJAX() or exit();

        $postData = $this->request->getPost();
        $length = 10;
        $start = ($postData['page'] > 1) ? ($postData['page'] * $length) - $length : 0;

        if (isset($postData['q'])) {
            $this->m_assets->groupStart()->like('name', $postData['q'])->orLike('id', $postData['q'])->groupEnd();
        }
        $assets = $this->m_assets->select('id, name AS text')->limit($length, $start)->find();
        $totalAsset = $this->m_assets->countAllResults();
        $totalPage = ceil($totalAsset / $length);
        $output = [
            'results'    => $assets,
            'pagination' => ['more' => false]
        ];
        if ($postData['page'] < $totalPage) {
            $output['pagination']['more'] = true;
        }
        $output = json_encode($output);

        echo $output;
    }
}
