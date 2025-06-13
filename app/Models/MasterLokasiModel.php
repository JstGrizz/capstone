<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterLokasiModel extends Model
{
    protected $table = 'master_lokasi';
    protected $primaryKey = 'lokasi_id';
    protected $allowedFields = ['nama_lokasi'];
    protected $returnType = 'array';
}
