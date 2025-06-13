<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\StatusModel;


class MasterStatusController extends ResourceController
{
    public function index()
    {
        $model = new StatusModel();
        $data['statuses'] = $model->findAll();
        return view('admin/master-status', $data);
    }

    public function showAll()
    {
        $model = new StatusModel();
        $data = $model->findAll();
        return $this->response->setJSON(['blok' => $data]);
    }

    public function show($id = null)
    {
        $model = new StatusModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Status dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function add()
    {
        return view('admin/create-status');
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $statusModel = new StatusModel();

        // Ambil dan trim input nama_status
        $namaStatus = trim($json->nama_status ?? '');

        // Validasi: nama_status tidak boleh kosong
        if (empty($namaStatus)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nama status harus diisi.'
            ]);
        }

        // Cek duplikat: apakah sudah ada status dengan nama yang sama?
        $duplicate = $statusModel
            ->where('nama_status', $namaStatus)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status dengan nama tersebut sudah ada.'
            ]);
        }

        // Siapkan data untuk insert
        $data = [
            'nama_status' => $namaStatus,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        try {
            $insertId = $statusModel->insert($data);

            if (! $insertId) {
                // Insert gagal—bisa karena validasi model lain atau constraint DB
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan status.'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status berhasil ditambahkan.',
                'id'      => $insertId
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan status: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($statusId = null)
    {
        $statusModel = new StatusModel();
        $status = $statusModel->find($statusId);

        if (!$status) {
            return redirect()->to('/master-status')->with('error', 'Status tidak ditemukan.');
        }

        return view('admin/edit-status', ['status' => $status]);
    }

    public function update($statusId = null)
    {
        $json = $this->request->getJSON();

        // Validasi ID
        if (! $statusId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid Status ID.'
            ]);
        }

        $statusModel = new StatusModel();

        // Cek apakah record dengan ID tersebut benar-benar ada
        $existing = $statusModel->find($statusId);
        if (! $existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status dengan ID tersebut tidak ditemukan.'
            ]);
        }

        // Ambil dan trim input nama_status
        $namaStatus = trim($json->nama_status ?? '');
        if (empty($namaStatus)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nama status harus diisi.'
            ]);
        }

        // Cek duplikat: cari record lain (status_id != $statusId) dengan nama_status yang sama
        $duplicate = $statusModel
            ->where('nama_status', $namaStatus)
            ->where('status_id !=', $statusId)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status dengan nama tersebut sudah ada.'
            ]);
        }

        // Siapkan data untuk update
        $data = [
            'nama_status' => $namaStatus,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        try {
            $result = $statusModel->update($statusId, $data);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui.'
                ]);
            } else {
                // Jika update mengembalikan false, kemungkinan tidak ada perubahan
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada perubahan pada data.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($statusId = null)
    {
        if (!$statusId) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID status tidak valid.']);
        }

        $model = new StatusModel();
        if ($model->delete($statusId)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus status.']);
        }
    }
}
