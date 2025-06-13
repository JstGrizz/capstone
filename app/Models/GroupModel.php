<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'group_karyawan';
    protected $primaryKey = 'group_id';
    protected $allowedFields = ['nama_group', 'tipe_group', 'lokasi_id'];
    protected $returnType = 'array';

    public function getGroupKaryawanWithLokasi()
    {
        return $this->select('group_karyawan.*, master_lokasi.nama_lokasi')
            ->join('master_lokasi', 'master_lokasi.lokasi_id = group_karyawan.lokasi_id', 'left')
            ->findAll();
    }
}
