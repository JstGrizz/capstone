<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\GroupModel;

class GroupKaryawanController extends ResourceController
{
    protected $modelName = 'App\Models\GroupModel';
    protected $format = 'json';

    public function index()
    {
        $model = new GroupModel();
        $data['groups'] = $model->getGroupKaryawanWithLokasi();


        // Pass the data to the respective view
        return view('admin/group-karyawan', $data);
    }

    public function showAll()
    {
        $data = $this->model->findAll();
        return $this->response->setJSON(['group' => $data]);
    }

    public function show($id = null)
    {
        $group = $this->model->find($id);
        if (!$group) {
            return $this->failNotFound('Group dengan ID ' . $id . ' tidak ditemukan');
        }
        return $this->respond($group);
    }

    public function add()
    {
        return view('admin/create-group');
    }


    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->fail('Invalid JSON input', 400);
        }

        if (empty($json->nama_group)) {
            return $this->fail('Missing nama_group value', 400);
        }

        if ($this->model->insert($json)) {
            return $this->respondCreated(['message' => 'Group berhasil ditambahkan']);
        } else {
            return $this->failServerError('Gagal menambahkan group', 500);
        }
    }

    public function edit($group_id = null)
    {
        $group = $this->model->find($group_id);
        if (!$group) {
            return redirect()->to('/group-karyawan')->with('error', 'Karyawan not found.');
        }
        return view('admin/edit-group', ['group' => $group]);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid JSON data'])->setStatusCode(400);
        }

        if (!$this->model->find($id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Group tidak ditemukan'])->setStatusCode(404);
        }

        if ($this->model->update($id, $json)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Group berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui group', 'errors' => $this->model->errors()], 400);
        }
    }

    public function delete($group_id = null)
    {
        try {
            $this->model->transStart();

            $this->model->delete($group_id);

            // Check the transaction status and commit if no problems
            if ($this->model->transStatus() === false) {
                $this->model->transRollback();
                return $this->failServerError('Gagal menghapus Group Karyawan');
            } else {
                $this->model->transComplete();
                return $this->respondDeleted(['message' => 'Data Group Karyawan berhasil dihapus']);
            }
        } catch (\Throwable $e) {
            $this->model->transRollback();
            return $this->fail($e->getMessage(), 400);
        }
    }
}
