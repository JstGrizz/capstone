<?php

namespace App\Models;

use CodeIgniter\Model;

class RfidGroupModel extends Model
{
    protected $table = 'rfid_group';
    protected $primaryKey = 'rfid_id';
    protected $allowedFields = ['rfid', 'group_id', 'npk', 'role_lapangan'];
    protected $returnType = 'array';
    protected $useAutoIncrement = true;

    public function getMemberDataByGroup($group_id = null)
    {
        $this->select('rfid_group.*, group_karyawan.nama_group, karyawan.nama');
        $this->join('group_karyawan', 'group_karyawan.group_id = rfid_group.group_id', 'left');
        $this->join('karyawan', 'karyawan.npk = rfid_group.npk', 'left');

        if ($group_id !== null) {
            $this->where('rfid_group.group_id', $group_id);
        }

        return $this->findAll();
    }

    public function getMemberDataByRfidId($rfid_id = null)
    {
        $this->select('rfid_group.*, group_karyawan.nama_group, karyawan.nama');
        $this->join('group_karyawan', 'group_karyawan.group_id = rfid_group.group_id', 'left');
        $this->join('karyawan', 'karyawan.npk = rfid_group.npk', 'left');

        if ($rfid_id !== null) {
            $this->where('rfid_group.rfid_id', $rfid_id);
        }

        return $this->first();
    }

    public function getMemberDataByRfid($rfid = null)
    {
        return $this->select('rfid_group.*, group_karyawan.nama_group, karyawan.nama')
            ->join('group_karyawan', 'group_karyawan.group_id = rfid_group.group_id', 'left')
            ->join('karyawan', 'karyawan.npk = rfid_group.npk', 'left')
            ->where('rfid_group.rfid', $rfid)
            ->first();
    }
}
