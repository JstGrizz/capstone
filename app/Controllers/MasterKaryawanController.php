<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KaryawanModel;
use App\Models\UsersModel;

class MasterKaryawanController extends ResourceController
{
    protected $modelName = 'App\Models\KaryawanModel';
    protected $format = 'json';


    public function index()
    {
        $model = new KaryawanModel();
        $data['karyawan'] = $model->getKaryawanWithLokasi();

        return view('admin/master-karyawan', $data);
    }

    public function showAll()
    {
        $data = $this->model->findAll();
        return $this->response->setJSON(['karyawan' => $data]);
    }

    public function show($id = null)
    {
        $lokasi = $this->model->find($id);
        if (!$lokasi) {
            return $this->failNotFound('Karyawan dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($lokasi);
    }

    public function add()
    {
        return view('admin/create-karyawan');
    }

    public function create()
    {
        $json = $this->request->getJSON();

        // Check if the JSON data was received correctly
        if (!$json) {
            return $this->fail('Invalid JSON input', 400);
        }

        // Check if 'npk' is set in the JSON
        if (empty($json->npk)) {
            return $this->fail('Missing npk value', 400);
        }

        // Check if a karyawan with the same npk already exists
        $existingKaryawan = $this->model->where('npk', $json->npk)->first();
        if ($existingKaryawan) {
            return $this->fail(['message' => 'NPK sudah Terpakai'], 409); // 409 Conflict
        }

        // Attempt to insert data into the database
        $insertResult = $this->model->insert($json);
        $errors = $this->model->errors();

        // Debugging logs
        log_message('error', 'Attempting to insert data: ' . json_encode($json));
        if ($insertResult) {
            log_message('error', 'Data inserted successfully');
            if (!empty($errors)) {
                log_message('error', 'Insert reported success, but errors were found: ' . json_encode($errors));
                return $this->fail($errors, 500);
            }
            return $this->respondCreated(['message' => 'Karyawan Berhasil Ditambahkan']);
        } else {
            log_message('error', 'Failed to insert data: ' . json_encode($errors));
            return $this->fail($errors ?? 'Gagal Menambahkan Karyawan', 500);
        }
    }


    public function edit($id = null)
    {
        $karyawan = $this->model->find($id);
        if (!$karyawan) {
            return redirect()->to('/master-karyawan')->with('error', 'Karyawan not found.');
        }
        return view('admin/edit-karyawan', ['karyawan' => $karyawan]);
    }

    public function update($karyawan_id = null)
    {
        $json = $this->request->getJSON(true);
        log_message('error', 'Attempting to insert data: ' . json_encode($json));
        if (!$json) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid JSON data'])->setStatusCode(400);
        }

        if ($this->model->update($karyawan_id, $json)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Karyawan updated successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update karyawan.', 'errors' => $this->model->errors()], 400);
        }
    }


    public function delete($karyawan_id = null)
    {
        try {
            $this->model->transStart();

            $userModel = new UsersModel();
            if ($user = $userModel->find($karyawan_id)) {
                $userModel->delete($karyawan_id);
            }

            if (!$this->model->find($karyawan_id)) {
                $this->model->transRollback();
                return $this->failNotFound('Karyawan dengan karyawan_id ' . $karyawan_id . ' tidak ditemukan');
            }

            $this->model->delete($karyawan_id);

            // Check the transaction status and commit if no problems
            if ($this->model->transStatus() === false) {
                $this->model->transRollback();
                return $this->failServerError('Gagal menghapus karyawan dan user');
            } else {
                $this->model->transComplete();
                return $this->respondDeleted(['message' => 'Data karyawan dan user terkait berhasil dihapus']);
            }
        } catch (\Throwable $e) {
            $this->model->transRollback();
            return $this->fail($e->getMessage(), 400);
        }
    }
}
