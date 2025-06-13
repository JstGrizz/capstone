<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryLossesModel extends Model
{
    protected $table = 'history_losses';
    protected $primaryKey = 'history_losses_id';

    // List all fields you want to allow to be inserted/updated
    protected $allowedFields = [
        'tanaman_id',
        'tgl_mulai_identifikasi',
        'hs_id',
        'rfid_tanaman',
        'latitude_tanam',
        'longitude_tanam',
        'no_titik_tanam',
        'status_id',
        'sister',
        'is_loses',
        'losses_id',
        'deskripsi_loses',
        'tgl_akhir_identifikasi',
        'minggu',
        'nama_karyawan',
        'npk',
        'transaksi_id' // add if you added this field in migration and sync logic
    ];

    protected $returnType = 'array';

    // Optional: If you want timestamps handled automatically
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
