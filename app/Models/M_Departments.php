<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Departments extends Model
{
    protected $table      = 'department';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
