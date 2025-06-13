<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\HectareStatementModel;
use App\Models\MasterBlokModel;
use App\Models\PtEstateModel;

class HectareStatementController extends ResourceController
{
    public function index()
    {
        $model = new HectareStatementModel();
        $hectarStatements = $model->getHectarStatementsWithNames();

        foreach ($hectarStatements as &$statement) {
            $tanggalTanam = new \DateTime($statement['tanggal_tanam']);
            $today = new \DateTime();
            $interval = $today->diff($tanggalTanam);
            $statement['umur_tanam_minggu'] = floor($interval->days / 7); // Calculate full weeks
        }

        $data['hectareStatements'] = $hectarStatements;

        return view('admin/hectare-statement', $data);
    }

    public function showAll()
    {
        $model = new HectareStatementModel();
        $data = $model->findAll();
        return $this->response->setJSON(['blok' => $data]);
    }

    public function show($id = null)
    {
        $model = new HectareStatementModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Hectare Statement dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function add()
    {
        // Fetch the necessary data for PT Estate dropdown
        $blokModel = new MasterBlokModel();
        $ptEstateModel = new PtEstateModel();

        // Fetch all PT Estates
        $data['ptEstates'] = $ptEstateModel->findAll();

        return view('admin/create-hectare-statement', $data);
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $model = new HectareStatementModel();

        // Ambil dan trim input
        $luasTanah     = $json->luas_tanah ?? 0;
        $tanggalTanam  = $json->tanggal_tanam ?? null;
        $varianBibit   = trim($json->varian_bibit ?? '');
        $jumlahPohon   = $json->jumlah_pohon ?? 0;
        $sph           = $json->sph ?? 0;
        $blokId        = $json->blok_id ?? null;
        $ptEstateId    = $json->pt_estate_id ?? null;

        // Validasi wajib
        if (! $blokId || ! $ptEstateId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Blok dan PT-Estate harus dipilih.'
            ]);
        }

        if ($luasTanah <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Luas tanah harus lebih dari 0.'
            ]);
        }

        if ($jumlahPohon <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jumlah pohon harus lebih dari 0.'
            ]);
        }

        if ($sph <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'SPH harus lebih dari 0.'
            ]);
        }

        if (empty($varianBibit)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Varian bibit tidak boleh kosong.'
            ]);
        }

        // Validasi tanggal tanam dan ambil tahun/bulan
        try {
            $dt = new \DateTime($tanggalTanam);
            $tahunTanam = $dt->format('Y');
            $bulanTanam = $dt->format('F');
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tanggal tanam tidak valid.'
            ]);
        }

        // Cek duplikat: apakah sudah ada record untuk kombinasi blok+pt_estate?
        $exists = $model
            ->where('blok_id', $blokId)
            ->where('pt_estate_id', $ptEstateId)
            ->first();

        if ($exists) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data untuk blok dan PT-Estate ini sudah terdaftar.'
            ]);
        }

        // Siapkan data
        $data = [
            'luas_tanah'    => $luasTanah,
            'tanggal_tanam' => $tanggalTanam,
            'varian_bibit'  => $varianBibit,
            'jumlah_pohon'  => $jumlahPohon,
            'sph'           => $sph,
            'blok_id'       => $blokId,
            'pt_estate_id'  => $ptEstateId,
            'tahun_tanam'   => $tahunTanam,
            'bulan_tanam'   => $bulanTanam,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        try {
            $hsId = $model->insert($data);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil ditambahkan.',
                'hs_id'   => $hsId
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan data: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($hs_id = null)
    {
        // Fetch the necessary data for PT and Blok dropdowns
        $blokModel = new MasterBlokModel();
        $ptEstateModel = new PtEstateModel();
        $data['ptEstates'] = $ptEstateModel->findAll();

        if (!$hs_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID Hectar tidak valid.']);
        }

        $model = new HectareStatementModel();
        // Fetch the Hectar Statement data for editing
        $statement = $model->find($hs_id);
        if (!$statement) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data Hectar tidak ditemukan.']);
        }

        // Fetch the Bloks for the selected PT Estate
        $bloks = $blokModel->getBloksByPtEstateId($statement['pt_estate_id']);
        $data['bloks'] = $bloks;

        // Add the statement to the data array
        $data['statement'] = $statement;

        // Return the edit view with the data
        return view('admin/edit-hectare-statement', $data);
    }

    public function update($hs_id = null)
    {
        if (! $hs_id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid HS ID.'
            ]);
        }

        $json = $this->request->getJSON();
        $model = new HectareStatementModel();

        // Pastikan record ada
        $existing = $model->find($hs_id);
        if (! $existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data Hectare Statement tidak ditemukan.'
            ]);
        }

        // Ambil dan trim input
        $luasTanah     = $json->luas_tanah ?? 0;
        $tanggalTanam  = $json->tanggal_tanam ?? null;
        $varianBibit   = trim($json->varian_bibit ?? '');
        $jumlahPohon   = $json->jumlah_pohon ?? 0;
        $sph           = $json->sph ?? 0;
        $blokId        = $json->blok_id ?? null;
        $ptEstateId    = $json->pt_estate_id ?? null;

        // Validasi wajib
        if (! $blokId || ! $ptEstateId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Blok dan PT-Estate harus dipilih.'
            ]);
        }

        if ($luasTanah <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Luas tanah harus lebih dari 0.'
            ]);
        }

        if ($jumlahPohon <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jumlah pohon harus lebih dari 0.'
            ]);
        }

        if ($sph <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'SPH harus lebih dari 0.'
            ]);
        }

        if (empty($varianBibit)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Varian bibit tidak boleh kosong.'
            ]);
        }

        // Validasi tanggal tanam
        try {
            $dt = new \DateTime($tanggalTanam);
            $tahunTanam = $dt->format('Y');
            $bulanTanam = $dt->format('F');
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tanggal tanam tidak valid.'
            ]);
        }

        // Cek duplikat: cari record lain dengan blok+pt_estate yang sama
        $duplicate = $model
            ->where('blok_id', $blokId)
            ->where('pt_estate_id', $ptEstateId)
            ->where('hs_id !=', $hs_id)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data untuk blok dan PT-Estate ini sudah terdaftar.'
            ]);
        }

        // Siapkan data untuk update
        $data = [
            'luas_tanah'    => $luasTanah,
            'tanggal_tanam' => $tanggalTanam,
            'varian_bibit'  => $varianBibit,
            'jumlah_pohon'  => $jumlahPohon,
            'sph'           => $sph,
            'blok_id'       => $blokId,
            'pt_estate_id'  => $ptEstateId,
            'tahun_tanam'   => $tahunTanam,
            'bulan_tanam'   => $bulanTanam,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        try {
            $result = $model->update($hs_id, $data);
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data berhasil diperbarui.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada perubahan pada data.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

    public function getBloksByPtEstateId($pt_estate_id)
    {
        $blokModel = new MasterBlokModel();
        // Fetch Bloks filtered by pt_estate_id
        $bloks = $blokModel->getBloksByPtEstateId($pt_estate_id);

        return $this->response->setJSON($bloks);
    }

    public function delete($hs_id = null)
    {
        if (!$hs_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID Hectar tidak valid.']);
        }

        $model = new HectareStatementModel();

        try {
            $result = $model->delete($hs_id);
            if ($result) {
                return $this->response->setJSON(['success' => true, 'message' => 'Data Hectar berhasil dihapus.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data Hectar.']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data Hectar: ' . $e->getMessage()]);
        }
    }
}
