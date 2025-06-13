<?php

namespace App\Models;

use CodeIgniter\Model;

class PtEstateModel extends Model
{
    protected $table = 'pt_estate';
    protected $primaryKey = 'pt_estate_id';
    protected $allowedFields = ['pt', 'estate'];
    protected $returnType = 'array';
}
