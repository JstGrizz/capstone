<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MasterLossesModel;


class MasterLossesController extends ResourceController
{
    protected $modelName = 'App\Models\MasterLossesModel';
    protected $format = 'json';

    public function index()
    {
        $model = new MasterLossesModel();
        $data['losses'] = $model->findAll();
        return view('admin/master-losses', $data);
    }

    public function showAll()
    {
        $model = new MasterLossesModel();
        $data = $model->findAll();
        return $this->response->setJSON(['policy' => $data]);
    }

    public function show($id = null)
    {
        $model = new MasterLossesModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Losses dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }


    public function delete($losses_id = null)
    {
        $model = new MasterLossesModel();
        if ($model->delete($losses_id)) {
            return $this->response->setJSON(['message' => 'Penyebab losses berhasil dihapus', 'success' => true]);
        } else {
            return $this->response->setJSON(['message' => 'Gagal menghapus penyebab losses', 'success' => false]);
        }
    }

    public function add()
    {
        // Load the view for creating new losses
        return view('admin/create-losses');
    }

    public function create()
    {
        $model = new MasterLossesModel();
        $data = $this->request->getJSON(true);

        if ($model->insert($data)) {
            return $this->response->setJSON(['message' => 'Penyebab losses berhasil ditambahkan', 'success' => true]);
        } else {
            return $this->response->setJSON(['message' => 'Gagal menambahkan penyebab losses', 'success' => false]);
        }
    }

    public function edit($id = null)
    {
        $model = new MasterLossesModel();
        $loss = $model->find($id);
        return view('admin/edit-losses', ['loss' => $loss]);
    }

    public function update($id = null)
    {
        $model = new MasterLossesModel();
        $data = $this->request->getJSON(true);
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['message' => 'Penyebab losses berhasil diupdate', 'success' => true]);
        } else {
            return $this->response->setJSON(['message' => 'Gagal mengupdate penyebab losses', 'success' => false]);
        }
    }
}
