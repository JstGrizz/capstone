<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;
use App\Models\KaryawanModel;

class MasterUserController extends ResourceController
{

    public function index()
    {
        $model = new UsersModel();
        $data['users'] = $model->findAll();
        return view('admin/master-user', $data);
    }

    public function showAll()
    {
        $model = new UsersModel();
        $data = $model->findAll();
        return $this->response->setJSON(['users' => $data]);
    }

    public function show($id = null)
    {
        $model = new UsersModel();
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Lokasi dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($data);
    }

    public function add()
    {
        $karyawanModel = new KaryawanModel();
        $usersModel = new UsersModel();

        $usedNPKs = $usersModel->select('npk')->findAll();

        $usedNPKsArray = array_column($usedNPKs, 'npk');

        $availableKaryawans = $karyawanModel->whereNotIn('npk', $usedNPKsArray)->findAll();

        $data = [
            'karyawans' => $availableKaryawans
        ];

        return view('admin/create-user', $data);
    }

    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->fail('Input JSON tidak valid', 400);
        }

        $validationRules = [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'npk' => 'required|is_unique[users.npk]'
        ];

        if (!$this->validate($validationRules)) {
            return $this->fail($this->validator->getErrors(), 400, 'Kesalahan Validasi');
        }

        $model = new UsersModel();
        $userData = [
            'username' => $json->username,
            'password' => password_hash($json->password, PASSWORD_DEFAULT),
            'role' => $json->role,
            'npk' => $json->npk
        ];

        if ($model->insert($userData)) {
            return $this->respondCreated(['message' => 'User berhasil ditambahkan', 'success' => true]);
        } else {
            return $this->failServerError('Tidak dapat menambahkan user', 500);
        }
    }

    public function edit($user_id = null)
    {
        $usersModel = new UsersModel();

        $user = $usersModel->find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'user' => $user
        ];

        return view('admin/edit-user', $data);
    }

    public function update($user_id = null)
    {
        $usersModel = new UsersModel();
        $json = $this->request->getJSON();  // Fetch JSON from the request

        if (!$json) {
            return $this->fail('Invalid JSON input', 400);
        }

        $dataToUpdate = [
            'username' => $json->username,
            'role' => $json->role
        ];

        if (!empty($json->password)) {
            $dataToUpdate['password'] = password_hash($json->password, PASSWORD_DEFAULT);
        }

        if ($usersModel->update($user_id, $dataToUpdate)) {
            return $this->respondUpdated(['message' => 'Data user berhasil diupdate', 'success' => true]);
        } else {
            return $this->failServerError('Gagal mengupdate data user');
        }
    }


    public function delete($user_id = null)
    {
        $model = new UsersModel();
        if ($model->delete($user_id)) {
            return $this->respondDeleted(['message' => 'User berhasil dihapus', 'success' => true]);
        } else {
            return $this->failNotFound('User tidak ditemukan');
        }
    }
}
