<?php

namespace App\Controllers;

use App\Models\M_Asset_purchase;
use App\Models\M_Asset_types;
use App\Models\M_Assets;
use App\Models\M_Departments;
use App\Models\M_Employees;
use App\Models\M_Positions;
use Irsyadulibad\DataTables\DataTables;

class Utilities extends BaseController
{
    protected $validation;
    protected $m_asset_types;
    protected $m_assets;
    protected $m_purchase;
    protected $m_positions;
    protected $m_departments;
    protected $m_employees;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->m_asset_types = new M_Asset_types();
        $this->m_assets = new M_Assets();
        $this->m_purchase = new M_Asset_purchase();
        $this->m_positions = new M_Positions();
        $this->m_departments = new M_Departments();
        $this->m_employees = new M_Employees();
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
        $data['content'] = 'Data jabatan di perusahaan';
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

    public function listdata_positions()
    {
        return DataTables::use('position')
            ->where(['deleted_at' => NULL])
            ->select('name, id')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('utilities/form_positions/' . $data->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_positions\',\'' . $data->id . '\')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>';
                return $button_action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function listdata_departments()
    {
        return DataTables::use('department')
            ->where(['deleted_at' => NULL])
            ->select('name, id')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('utilities/form_departments/' . $data->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_departments\',\'' . $data->id . '\')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>';
                return $button_action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function listdata_employees()
    {
        return DataTables::use('employee')
            ->where(['employee.deleted_at' => NULL])
            ->select('employee.name as employee_name, nip, position.name as position_name, department.name as department_name, employee.id as employee_id')
            ->join('position', 'employee.position_id = position.id', 'LEFT JOIN')
            ->join('department', 'employee.department_id = department.id', 'LEFT JOIN')
            ->addColumn('action', function ($data) {
                $button_action = '<a href="' . base_url('utilities/form_employees/' . $data->employee_id) . '" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData(\'_dat_employees\',\'' . $data->employee_id . '\')" title="Delete">
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
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' asset types';
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
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' asset purchase';
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

    public function form_positions($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Positions';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' jabatan';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' positions';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_positions';
        $data['back_url'] = base_url('utilities/positions');
        $data['action_url'] = base_url('utilities/save_positions/' . (empty($id) ? '' : $id));
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_positions->find($id);
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
            return view('utilities/form/form_positions', $data);
        }
    }

    public function form_departments($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Departments';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' departemen';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' departments';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_departments';
        $data['back_url'] = base_url('utilities/departments');
        $data['action_url'] = base_url('utilities/save_departments/' . (empty($id) ? '' : $id));
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_departments->find($id);
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
            return view('utilities/form/form_departments', $data);
        }
    }

    public function form_employees($id = '')
    {
        $data['title_page'] = ((empty($id)) ? 'Tambah' : 'Rubah') . ' Employees';
        $data['content'] = 'Form untuk ' . ((empty($id)) ? 'menambahkan' : 'merubah') . ' karyawan';
        $data['title_card'] = 'Form ' . ((empty($id)) ? 'add' : 'edit') . ' employees';
        $data['menu'] = 'utilities';
        $data['submenu'] = 'utilities_employees';
        $data['back_url'] = base_url('utilities/employees');
        $data['action_url'] = base_url('utilities/save_employees/' . (empty($id) ? '' : $id));
        $data['id'] = (empty($id)) ? 0 : $id;
        $data['is_edit'] = false;
        $data['validation'] = $this->validation;
        $data['positions'] = $this->m_positions->findAll();
        $data['departments'] = $this->m_departments->findAll();
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $data['is_edit'] = true;
                $exist = $this->m_employees->find($id);
                if ($exist) {
                    $position = $this->m_positions->find($exist->position_id);
                    $department = $this->m_departments->find($exist->department_id);
                    $data['name'] = $exist->name;
                    $data['nip'] = $exist->nip;
                    $data['position_id_edit'] = $position->id;
                    $data['position_name_edit'] = $position->name;
                    $data['department_id_edit'] = $department->id;
                    $data['department_name_edit'] = $department->name;
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
            return view('utilities/form/form_employees', $data);
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

    public function save_positions($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('positions'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('utilities/form_positions/' . (empty($id) ? '' : $id)))->withInput();
        }
        $postData = $this->request->getPost();
        $err = false;
        $position_id = $postData['positions_id'];
        if (!empty($position_id)) {
            if (is_numeric($position_id)) {
                $exist = $this->m_positions->find($position_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_positions->update($position_id, $postData);
                    session()->setFlashdata('info', 'success_edit');
                } else {
                    session()->setFlashdata('info', 'error_edit');
                }
            } else {
                $err = true;
            }
        } else {
            if (is_numeric($position_id)) {
                $postData['created_by'] = user_id();
                $this->m_positions->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/positions'));
        }
    }

    public function save_departments($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('departments'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('utilities/form_departments/' . (empty($id) ? '' : $id)))->withInput();
        }
        $postData = $this->request->getPost();
        $err = false;
        $department_id = $postData['departments_id'];
        if (!empty($department_id)) {
            if (is_numeric($department_id)) {
                $exist = $this->m_departments->find($department_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_departments->update($department_id, $postData);
                    session()->setFlashdata('info', 'success_edit');
                } else {
                    session()->setFlashdata('info', 'error_edit');
                }
            } else {
                $err = true;
            }
        } else {
            if (is_numeric($department_id)) {
                $postData['created_by'] = user_id();
                $this->m_departments->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/departments'));
        }
    }

    public function save_employees($id = '')
    {
        if (!$this->validate($this->validation->getRuleGroup('employees'))) {
            session()->setFlashdata('info', (empty($id)) ? 'error_add' : 'error_edit');
            return redirect()->to(base_url('utilities/form_employees/' . (empty($id) ? '' : $id)))->withInput();
        }
        $postData = $this->request->getPost();
        $err = false;
        $employee_id = $postData['employees_id'];
        if (!empty($employee_id)) {
            if (is_numeric($employee_id)) {
                $exist = $this->m_employees->find($employee_id);
                if ($exist) {
                    $postData['updated_by'] = user_id();
                    $this->m_employees->update($employee_id, $postData);
                    session()->setFlashdata('info', 'success_edit');
                } else {
                    session()->setFlashdata('info', 'error_edit');
                }
            } else {
                $err = true;
            }
        } else {
            if (is_numeric($employee_id)) {
                $postData['created_by'] = user_id();
                $this->m_employees->insert($postData);
                session()->setFlashdata('info', 'success_add');
            } else {
                $err = true;
            }
        }

        if ($err) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return redirect()->to(base_url('utilities/employees'));
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

    public function delete_positions($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_positions->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_positions->update($id, $data);
                    $this->m_positions->delete($id);
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
            return redirect()->to(base_url('utilities/positions'));
        }
    }

    public function delete_departments($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_departments->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_departments->update($id, $data);
                    $this->m_departments->delete($id);
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
            return redirect()->to(base_url('utilities/departments'));
        }
    }

    public function delete_employees($id)
    {
        $err = false;
        if (!empty($id)) {
            if (is_numeric($id)) {
                $exist = $this->m_employees->find($id);
                if ($exist) {
                    $data['deleted_by'] = user_id();
                    $this->m_employees->update($id, $data);
                    $this->m_employees->delete($id);
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
            return redirect()->to(base_url('utilities/employees'));
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
