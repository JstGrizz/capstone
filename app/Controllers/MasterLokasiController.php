<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MasterLokasiModel;

class MasterLokasiController extends ResourceController
{
    protected $modelName = 'App\Models\MasterLokasiModel';
    protected $format = 'json';

    public function index()
    {
        $model = new MasterLokasiModel();
        $data['lokasi'] = $model->findAll();
        return view('admin/master-lokasi', $data);
    }

    public function showAll()
    {
        $data = $this->model->findAll();
        return $this->response->setJSON(['lokasi' => $data]);
    }

    public function show($id = null)
    {
        $lokasi = $this->model->find($id);
        if (!$lokasi) {
            return $this->failNotFound('Lokasi dengan ID ' . $id . ' tidak ditemukan');
        }

        return $this->respond($lokasi);
    }



    public function add()
    {
        return view('admin/create-lokasi');
    }

    public function create()
    {
        $json = $this->request->getJSON();
        $nama_lokasi = $json->nama_lokasi ?? null;

        if (!$nama_lokasi) {
            return $this->failValidationErrors("Nama lokasi is required.");
        }

        $data = [
            'nama_lokasi' => $nama_lokasi,
        ];

        if ($this->model->insert($data)) {
            return $this->respondCreated(['success' => true, 'message' => 'Lokasi successfully added.']);
        } else {
            return $this->failServerError('Unable to create lokasi.');
        }
    }

    public function edit($id = null)
    {
        $lokasi = $this->model->find($id);
        if (!$lokasi) {
            return redirect()->back()->with('error', 'Lokasi tidak ditemukan');
        }

        return view('admin/edit-lokasi', ['lokasi' => $lokasi]);
    }


    public function update($id = null)
    {
        $json = $this->request->getJSON(); // Use getJSON() to fetch the JSON data sent in the request

        if (!$this->model->find($id)) {
            return $this->failNotFound('Lokasi dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'nama_lokasi' => $json->nama_lokasi ?? null,
        ];

        if ($this->model->update($id, $data)) {
            return $this->respondUpdated(['success' => true, 'message' => 'Lokasi berhasil diperbarui.']);
        } else {
            return $this->fail('Gagal memperbarui lokasi.', 400, $this->model->errors());
        }
    }


    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Lokasi dengan ID ' . $id . ' tidak ditemukan.');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Lokasi berhasil dihapus.']);
        } else {
            return $this->failServerError('Gagal menghapus lokasi.');
        }
    }
}
