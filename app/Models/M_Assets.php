<?php

namespace App\Models;

use Codeigniter\Model;

class M_Assets extends Model
{
    protected $table      = 'asset';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'type_asset',
        'category',
        'detail',
        'total',
        'qty',
        'price',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
