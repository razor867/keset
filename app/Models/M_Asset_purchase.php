<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asset_purchase extends Model
{
    protected $table      = 'purchase';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'asset_id',
        'total',
        'price',
        'total_price',
        'seller',
        'date',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
