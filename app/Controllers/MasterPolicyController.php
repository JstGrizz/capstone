<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PolicyModel;

class MasterPolicyController extends ResourceController
{
    protected $modelName = 'App\Models\PolicyModel';
    protected $format = 'json';

    public function index()
    {
        $policies = $this->model->findAll();
        return view('admin/master-policy', ['policies' => $policies]);
    }


    public function showAll()
    {
        $model = new PolicyModel();
        $data = $model->findAll();
        return $this->response->setJSON(['policy' => $data]);
    }

    public function show($id = null)
    {
        $model = new PolicyModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Policy dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function delete($policy_id = null)
    {
        if ($this->model->delete($policy_id)) {
            return $this->respondDeleted(['message' => 'Kebijakan berhasil dihapus', 'success' => true]);
        } else {
            return $this->failServerError('Gagal menghapus kebijakan');
        }
    }

    public function add()
    {
        return view('admin/create-policy');
    }

    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->fail('Invalid JSON', 400);
        }

        $policyData = [
            'deskripsi'    => $json->deskripsi ?? '',
            'satuan'       => $json->satuan ?? '',
            'lama'         => $json->lama ?? '',
            'akhir'        => $json->akhir ?? '',
            'baru'         => $json->baru ?? '',
            'start'        => $json->start ?? ''
        ];

        if ($this->model->insert($policyData)) {
            return $this->respondCreated(['message' => 'Kebijakan berhasil ditambahkan', 'success' => true]);
        } else {
            return $this->failServerError('Gagal menambahkan kebijakan');
        }
    }

    public function edit($policy_id = null)
    {
        $model = new PolicyModel();
        $data['policy'] = $model->find($policy_id);

        return view('admin/edit-policy', $data);
    }

    public function update($policy_id = null)
    {
        $json = $this->request->getJSON();
        if (!$json) {
            return $this->fail('Invalid JSON', 400);
        }

        $model = new PolicyModel();
        $data = [
            'deskripsi' => $json->deskripsi,
            'satuan' => $json->satuan,
            'lama' => $json->lama,
            'akhir' => $json->akhir,
            'baru' => $json->baru,
            'start' => $json->start,
        ];

        if ($model->update($policy_id, $data)) {
            return $this->respondUpdated(['message' => 'Kebijakan berhasil diupdate', 'success' => true]);
        } else {
            return $this->failServerError('Gagal mengupdate kebijakan');
        }
    }
}
