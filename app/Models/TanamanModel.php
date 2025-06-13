<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamanModel extends Model
{
    protected $table = 'tanaman';
    protected $primaryKey = 'tanaman_id';
    protected $allowedFields = ['tgl_mulai_identifikasi', 'hs_id', 'rfid_tanaman', 'latitude_tanam', 'longitude_tanam', 'no_titik_tanam', 'status_id', 'sister', 'is_loses', 'losses_id', 'deskripsi_loses', 'tgl_akhir_identifikasi', 'minggu', 'nama_karyawan', 'npk'];
    protected $returnType = 'array';

    public function getNoTitikTanamData($noTitikTanam, $hsId)
    {
        return $this->select('latitude_tanam, longitude_tanam')
            ->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId)
            ->first();
    }

    public function getNoActiveTanamData($noTitikTanam)
    {
        return $this->select('tanaman.tanaman_id, tanaman.rfid_tanaman, tanaman.sister, tanaman.status_id, status.nama_status')
            ->join('status', 'tanaman.status_id = status.status_id')
            ->where('tanaman.no_titik_tanam', $noTitikTanam)
            ->where('tanaman.tgl_mulai_identifikasi IS NOT NULL')
            ->where('tanaman.tgl_akhir_identifikasi IS NULL')
            ->findAll();
    }

    public function fetchLatestStatusForTitikTanam($longitudeTanam, $latitudeTanam, $noTitikTanam, $hsId)
    {
        return $this->select('status_id')
            ->where('longitude_tanam', $longitudeTanam)
            ->where('latitude_tanam', $latitudeTanam)
            ->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId)
            ->orderBy('tgl_mulai_identifikasi', 'DESC')
            ->first()['status_id'] ?? null;
    }

    public function checkIfStatusIsActive($longitudeTanam, $latitudeTanam, $noTitikTanam, $hsId, $statusID)
    {
        $activeCount = $this->where('longitude_tanam', $longitudeTanam)
            ->where('latitude_tanam', $latitudeTanam)
            ->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId)
            ->where('status_id', $statusID)
            ->where('tgl_akhir_identifikasi', null)
            ->countAllResults();

        return $activeCount > 0;
    }

    // Fetch the maximum sister and active count based on latitude, longitude, or no_titik_tanam
    public function fetchLatestSisterForTitikTanam($latitude, $longitude, $noTitikTanam, $hsId)
    {
        // Fetch the max sister value
        $maxSister = $this->selectMax('sister')
            ->where('latitude_tanam', $latitude)
            ->where('longitude_tanam', $longitude)
            ->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId)
            ->first()['sister'] ?? 0;

        // Count active records
        $activeCount = $this->where('tgl_akhir_identifikasi', null)
            ->where('latitude_tanam', $latitude)
            ->where('longitude_tanam', $longitude)
            ->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId)
            ->countAllResults() ?? 0;

        return ['max_sister' => $maxSister, 'active_count' => $activeCount];
    }

    // Method to update the tanaman data based on no_titik_tanam and hs_id
    public function updateTanamanData($noTitikTanam, $hsId, $index, $updateData)
    {
        return $this->where('no_titik_tanam', $noTitikTanam)
            ->where('hs_id', $hsId) // Filter by hs_id as well
            ->where('tanaman_id', $index) // Assuming the index corresponds to tanaman_id
            ->set($updateData)
            ->update();
    }
}
