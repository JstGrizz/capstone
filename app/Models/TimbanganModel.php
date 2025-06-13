<?php

namespace App\Models;

use CodeIgniter\Model;

class TimbanganModel extends Model
{
    protected $table = 'timbangan';
    protected $primaryKey = 'transaksi_id';
    protected $allowedFields = ['tgl_transaksi', 'hs_id', 'status_id', 'berat_timbangan', 'rfid_tanaman', 'group_id'];
    protected $returnType = 'array';
}
