<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MasterBlokModel;
use App\Models\PtEstateModel;


class MasterBlokController extends ResourceController
{
    public function index()
    {
        $model = new MasterBlokModel();
        $data['bloks'] = $model->getBlokWithPtEstateName();
        return view('admin/master-blok', $data);
    }

    public function showAll()
    {
        $model = new MasterBlokModel();
        $data = $model->findAll();
        return $this->response->setJSON(['blok' => $data]);
    }

    public function show($id = null)
    {
        $model = new MasterBlokModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Blok dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function add()
    {
        $ptEstateModel = new PtEstateModel();
        $ptEstates = $ptEstateModel->orderBy('pt', 'ASC')->findAll();

        $data = [
            'ptEstates' => $ptEstates,
            'title' => 'Tambah Blok'
        ];

        return view('admin/create-blok', $data);
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $blokModel = new MasterBlokModel();

        // Ambil dan bersihkan input
        $namaBlok = trim($json->nama_blok ?? '');
        $ptEstateId = $json->pt_estate_id ?? null;

        // Validasi: minimal nama_blok tidak boleh kosong dan pt_estate_id harus ada
        if (empty($namaBlok) || is_null($ptEstateId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nama blok dan PT-Estate ID harus diisi.'
            ]);
        }

        // Cek duplikat: apakah sudah ada master_blok dengan nama_blok & pt_estate_id yang sama?
        $duplicate = $blokModel
            ->where('nama_blok', $namaBlok)
            ->where('pt_estate_id', $ptEstateId)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Blok dengan nama tersebut sudah ada di PT-Estate ini.'
            ]);
        }

        // Siapkan data untuk insert
        $data = [
            'nama_blok'     => $namaBlok,
            'pt_estate_id'  => $ptEstateId,
        ];

        try {
            $insertId = $blokModel->insert($data);

            // Kalau insert gagal, $insertId akan false atau Model->errors() tidak kosong
            if (! $insertId || $blokModel->errors()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan blok.',
                    'errors'  => $blokModel->errors()
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Blok berhasil ditambahkan.',
                'id'      => $insertId
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan blok: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($blok_id = null)
    {
        $blokModel = new MasterBlokModel();
        $ptEstateModel = new PtEstateModel();

        // Fetch the single blok data
        $blok = $blokModel->find($blok_id);
        if (!$blok) {
            return redirect()->to('/master-blok')->with('error', 'Blok tidak ditemukan.');
        }

        // Fetch all pt-estates for the dropdown
        $ptEstates = $ptEstateModel->orderBy('pt', 'ASC')->findAll();

        $data = [
            'blok' => $blok,
            'ptEstates' => $ptEstates
        ];

        return view('admin/edit-blok', $data);
    }

    public function update($blokId = null)
    {
        if (! $blokId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid Blok ID.'
            ]);
        }

        $json = $this->request->getJSON();
        $blokModel   = new MasterBlokModel();
        $namaBlok    = trim($json->nama_blok ?? '');
        $ptEstateId  = $json->pt_estate_id ?? null;

        // Validasi: nama_blok dan pt_estate_id tidak boleh kosong
        if (empty($namaBlok) || is_null($ptEstateId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nama blok dan PT-Estate ID harus diisi.'
            ]);
        }

        // Cek apakah blok dengan ID tersebut benar-benar ada
        $existing = $blokModel->find($blokId);
        if (! $existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Blok dengan ID tersebut tidak ditemukan.'
            ]);
        }

        // Cek duplikat: cari record lain (blok_id != $blokId) dengan nama_blok & pt_estate_id yang sama
        $duplicate = $blokModel
            ->where('nama_blok', $namaBlok)
            ->where('pt_estate_id', $ptEstateId)
            ->where('blok_id !=', $blokId)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Blok dengan nama tersebut sudah ada pada PT-Estate yang sama.'
            ]);
        }

        // Siapkan data untuk update
        $data = [
            'nama_blok'     => $namaBlok,
            'pt_estate_id'  => $ptEstateId,
        ];

        try {
            $result = $blokModel->update($blokId, $data);
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Blok berhasil diperbarui.'
                ]);
            } else {
                // Bila model->update mengembalikan false, bisa jadi tidak ada perubahan
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada perubahan pada data.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui blok: ' . $e->getMessage()
            ]);
        }
    }


    public function delete($id = null)
    {
        $model = new MasterBlokModel();
        if ($model->delete($id)) {
            return $this->response->setJSON(['message' => 'Blok berhasil dihapus.', 'success' => true]);
        } else {
            return $this->response->setJSON(['message' => 'Gagal menghapus blok.', 'success' => false]);
        }
    }
}
