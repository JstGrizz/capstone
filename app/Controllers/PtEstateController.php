<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PtEstateModel;


class PtEstateController extends ResourceController
{

    public function index()
    {
        $model = new PtEstateModel();
        $data['ptEstates'] = $model->findAll();
        return view('admin/pt-estate', $data);
    }

    public function showAll()
    {
        $model = new PtEstateModel();
        $data = $model->orderBy('pt', 'ASC')->findAll();
        return $this->response->setJSON(['PtEstate' => $data]);
    }

    public function show($id = null)
    {
        $model = new PtEstateModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('PT Estate dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function delete($id = null)
    {
        $model = new PtEstateModel();
        if ($model->delete($id)) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'PT Estate berhasil dihapus.', 'success' => true]);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Gagal menghapus PT Estate.', 'success' => false]);
        }
    }

    public function add()
    {
        // Show add view page
        return view('admin/create-pt-estate');
    }

    public function create()
    {
        $model = new PtEstateModel();

        // Ambil input dari request
        $pt     = $this->request->getVar('pt');
        $estate = $this->request->getVar('estate');

        // Cek apakah input kosong (opsional, tapi sering disarankan)
        if (empty($pt) || empty($estate)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'message' => 'Field "pt" dan "estate" wajib diisi.',
                    'success' => false
                ]);
        }

        // Cari apakah sudah ada kombinasi pt+estate yang sama
        $existing = $model
            ->where('pt', $pt)
            ->where('estate', $estate)
            ->first();

        if ($existing) {
            // Jika sudah ada, kembalikan respons duplicate
            return $this->response
                ->setStatusCode(409) // 409 Conflict
                ->setJSON([
                    'message' => 'Data PT Estate dengan kombinasi yang sama sudah ada.',
                    'success' => false
                ]);
        }

        // Jika belum ada, lakukan insert
        $data = [
            'pt'     => $pt,
            'estate' => $estate
        ];

        if ($model->insert($data)) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'message' => 'PT Estate berhasil ditambahkan.',
                    'success' => true
                ]);
        } else {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'message' => 'Gagal menambahkan PT Estate.',
                    'success' => false
                ]);
        }
    }

    public function edit($id = null)
    {
        $model = new PtEstateModel();
        $data['pt_estate'] = $model->find($id);
        return view('admin/edit-pt-estate', $data);
    }

    public function update($id = null)
    {
        $model = new PtEstateModel();

        // Ambil input dan trim agar tidak ada spasi berlebih
        $pt     = trim($this->request->getVar('pt'));
        $estate = trim($this->request->getVar('estate'));

        // Nama kolom PK di tabel pt_estate
        $pk = 'pt_estate_id';

        // Cek duplikat: cari record lain (pt_estate_id != $id) dengan pt & estate yang sama
        $duplicate = $model
            ->where('pt', $pt)
            ->where('estate', $estate)
            ->where($pk . ' !=', $id)
            ->first();

        if ($duplicate) {
            return $this->response->setJSON([
                'message' => 'Kombinasi PT dan Estate sudah ada sebelumnya.',
                'success' => false
            ]);
        }

        // Jika tidak ada duplikat, lakukan update
        $data = [
            'pt'     => $pt,
            'estate' => $estate
        ];

        if ($model->update($id, $data)) {
            return $this->response->setJSON([
                'message' => 'PT Estate berhasil diperbarui.',
                'success' => true
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Gagal memperbarui PT Estate.',
                'success' => false
            ]);
        }
    }
}
