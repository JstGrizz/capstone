<?php

namespace App\Models;

use CodeIgniter\Model;

class PolicyModel extends Model
{
    protected $table = 'policy';
    protected $primaryKey = 'policy_id';
    protected $allowedFields = ['deskripsi', 'satuan', 'lama', 'akhir', 'baru', 'start', 'last_updated'];
    protected $returnType = 'array';
}
