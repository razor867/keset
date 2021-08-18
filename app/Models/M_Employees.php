<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Employees extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'nip',
        'position_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
