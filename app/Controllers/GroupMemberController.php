<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\RfidGroupModel;
use App\Models\GroupModel;
use App\Models\KaryawanModel;

class GroupMemberController extends ResourceController
{
    protected $modelName = 'App\Models\RfidGroupModel';
    protected $format = 'json';

    public function index($group_id = null)
    {
        $model = new RfidGroupModel();
        $data['members'] = $model->getMemberDataByGroup($group_id);

        // Pass the data to the respective view
        return view('admin/member-group', $data);
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

    public function add($group_id = null)
    {
        $groupModel = new GroupModel();
        $groups = $groupModel->getGroupKaryawanWithLokasi();

        $karyawanModel = new KaryawanModel();
        $karyawans = $karyawanModel->findAll();

        $data = [
            'groups' => $groups,
            'selectedGroup' => $group_id,
            'karyawans' => $karyawans,
            'group_id' => $group_id
        ];

        return view('admin/create-member', $data);
    }

    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->fail('Invalid JSON input', 400);
        }

        $validationRules = [
            'group_id' => 'required',
            'rfid' => 'required',
            'npk' => 'required',
            'role_lapangan' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return $this->fail($this->validator->getErrors(), 400, 'Validation Error');
        }

        $newMemberData = [
            'group_id' => $json->group_id,
            'rfid' => $json->rfid,
            'npk' => $json->npk,
            'role_lapangan' => $json->role_lapangan
        ];

        $model = new RfidGroupModel();
        if ($model->insert($newMemberData)) {
            return $this->respondCreated(['message' => 'Anggota berhasil ditambahkan', 'success' => true]);
        } else {
            return $this->failServerError('Tidak dapat menambahkan anggota', 500);
        }
    }

    public function edit($rfid_id = null)
    {
        $rfidGroupModel = new RfidGroupModel();
        $groupModel = new GroupModel();

        // Fetch the single member data
        $member = $rfidGroupModel->getMemberDataByRfidId($rfid_id);
        if (!$member) {
            return redirect()->to('/member-group')->with('error', 'Member group tidak ditemukan.');
        }
        $group_id = $member['group_id'];

        // Fetch all groups with location details for the dropdown
        $groups = $groupModel->getGroupKaryawanWithLokasi();

        $data = [
            'member' => $member,
            'groups' => $groups,
            'group_id' => $group_id
        ];

        return view('admin/edit-member', $data);
    }




    public function update($rfid_id = null)
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->respond(['success' => false, 'message' => 'Input JSON tidak valid'], 400);
        }

        if (!$this->model->find($rfid_id)) {
            return $this->respond(['success' => false, 'message' => 'Member tidak ditemukan'], 404);
        }

        $updateData = [
            'group_id' => $json->group_id,
            'rfid' => $json->rfid,
            'role_lapangan' => $json->role_lapangan
        ];

        if ($this->model->update($rfid_id, $updateData)) {
            return $this->respondUpdated(['success' => true, 'message' => 'Member berhasil diperbarui']);
        } else {
            return $this->respond(['success' => false, 'message' => 'Gagal memperbarui member', 'errors' => $this->model->errors()], 500);
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
