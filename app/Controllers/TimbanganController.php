<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TanamanModel;
use App\Models\KaryawanModel;
use App\Models\MasterBlokModel;
use App\Models\PtEstateModel;
use App\Models\StatusModel;
use App\Models\HectareStatementModel;
use App\Models\RfidGroupModel;
use App\Models\TimbanganModel;

class TimbanganController extends ResourceController
{
    public function index()
    {
        // Load view dan pass data
        return view('timbangan');
    }

    public function getDataGroup($rfid_group)
    {
        $rfidGroupModel = new RfidGroupModel();

        $rfidData = $rfidGroupModel->getMemberDataByRfid($rfid_group);

        if ($rfidData) {
            $groupMembers = $rfidGroupModel->getMemberDataByGroup($rfidData['group_id']);

            // Cari semua mandor dalam anggota grup
            $mandors = [];
            foreach ($groupMembers as $member) {
                if ($member['role_lapangan'] === 'mandor') {
                    $mandors[] = $member['nama'];
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'nama_group' => $rfidData['nama_group'],
                'nama_mandor' => $mandors,
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'RFID Group tidak ditemukan.',
            ]);
        }
    }

    public function getDataTanaman($rfid_tanaman)
    {
        $tanamanModel = new TanamanModel();
        $karyawanModel = new KaryawanModel();
        $blokModel = new MasterBlokModel();
        $ptEstateModel = new PtEstateModel();
        $statusModel = new StatusModel();
        $hectareModel = new HectareStatementModel();

        $tanaman = $tanamanModel->where('rfid_tanaman', $rfid_tanaman)
            ->where('tgl_akhir_identifikasi', null)->first();

        if ($tanaman) {
            $karyawan = $karyawanModel->where('npk', $tanaman['npk'])->first();
            $status = $statusModel->where('status_id', $tanaman['status_id'])->first();
            $hectare = $hectareModel->where('hs_id', $tanaman['hs_id'])->first();

            // Ambil blok_id dan pt_estate_id dari hectare_statement
            $blokId = $hectare ? $hectare['blok_id'] : null;
            $ptEstateId = $hectare ? $hectare['pt_estate_id'] : null;

            $blok = $blokId ? $blokModel->where('blok_id', $blokId)->first() : null;
            $ptEstate = $ptEstateId ? $ptEstateModel->where('pt_estate_id', $ptEstateId)->first() : null;

            return $this->response->setJSON([
                'success' => true,
                'nama_karyawan' => $karyawan ? $karyawan['nama'] : '',
                'npk' => $tanaman['npk'],
                'pt_estate' => $ptEstate ? $ptEstate['pt'] . ' - ' . $ptEstate['estate'] : '',
                'nama_blok' => $blok ? $blok['nama_blok'] : '',
                'status' => $status ? $status['nama_status'] : '',
                'sister' => $tanaman['sister'],
                'no_titik_tanam' => $tanaman['no_titik_tanam'],
                'tgl_identifikasi_tanaman' => $tanaman['tgl_mulai_identifikasi'],
                'tahun_tanam' => $hectare ? $hectare['tahun_tanam'] : '',
                'bulan_tanam' => $hectare ? $hectare['bulan_tanam'] : '',
                'luas_tanah' => $hectare ? $hectare['luas_tanah'] : '',
                'varian_bibit' => $hectare ? $hectare['varian_bibit'] : '',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'RFID Tanaman tidak ditemukan.',
            ]);
        }
    }

    public function insertTimbanganData()
    {
        $json = $this->request->getJSON();

        $rfidTanaman = $json->rfid_tanaman;
        $rfidGroup = $json->rfid_group;
        $beratTimbangan = $json->berat_timbangan;
        $tglTransaksi = date('Y-m-d H:i:s');

        $timbanganModel = new TimbanganModel();
        $tanamanModel = new TanamanModel();
        $rfidGroupModel = new RfidGroupModel();

        // Ambil data tanaman
        $tanaman = $tanamanModel->where('rfid_tanaman', $rfidTanaman)
            ->where('tgl_akhir_identifikasi', null)
            ->first();

        if (!$tanaman) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'RFID Tanaman tidak ditemukan atau tidak valid.',
            ]);
        }

        // Ambil data group
        $groupData = $rfidGroupModel->getMemberDataByRfid($rfidGroup);

        if (!$groupData) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'RFID Group tidak ditemukan.',
            ]);
        }

        $data = [
            'tgl_transaksi' => $tglTransaksi,
            'rfid_tanaman' => $rfidTanaman,
            'hs_id' => $tanaman['hs_id'],
            'status_id' => $tanaman['status_id'],
            'berat_timbangan' => $beratTimbangan,
            'group_id' => $groupData['group_id'],
        ];

        if ($timbanganModel->insert($data)) {
            // Update the tanaman table
            $updateData = ['tgl_akhir_identifikasi' => $tglTransaksi];
            $updateResult = $tanamanModel->update($tanaman['tanaman_id'], $updateData);

            if ($updateResult) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data timbangan berhasil disimpan dan tanaman diperbarui.',
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data berhasil disimpan namun gagal memperbarui tanaman.',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan data timbangan.',
            ]);
        }
    }
}
