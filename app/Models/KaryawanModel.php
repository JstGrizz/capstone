<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';


    protected $primaryKey = 'karyawan_id';


    protected $allowedFields = ['npk', 'nama', 'jabatan', 'gender', 'golongan', 'tgl_lahir', 'tgl_join', 'tgl_termination', 'QRCode', 'status_karyawan', 'lokasi_id'];

    protected $returnType = 'array';

    // Add this method
    public function getKaryawanWithLokasi()
    {
        return $this->select('karyawan.*, master_lokasi.nama_lokasi')
            ->join('master_lokasi', 'master_lokasi.lokasi_id = karyawan.lokasi_id', 'left')
            ->findAll();
    }

    public function getKaryawanNameWithNpk($npk = null)
    {
        return $this->where('npk', $npk)->first();
    }
}
