<?php

namespace App\Controllers;

use App\Models\MasterLokasiModel;
use App\Models\KaryawanModel;
use App\Models\GroupModel;
use App\Models\RfidGroupModel;
use App\Models\UsersModel;
use App\Models\PolicyModel;
use App\Models\MasterLossesModel;
use App\Models\PtEstateModel;
use App\Models\MasterBlokModel;
use App\Models\StatusModel;
use App\Models\HectareStatementModel;
use App\Models\TimbanganModel;
use App\Models\TanamanModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AndroidController extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function loginProcessAndroid()
    {
        $model   = new UsersModel();
        $json    = $this->request->getJSON();

        if (! $json) {
            return $this->respond([
                'success' => false,
                'message' => 'Invalid JSON data provided.'
            ], 400);
        }

        $npk      = $json->npk      ?? null;
        $password = $json->password ?? null;

        if (empty($npk) || empty($password)) {
            return $this->respond([
                'success' => false,
                'message' => 'NPK dan Password harus diisi.'
            ], 400);
        }

        if (! $user = $model->where('npk', $npk)->first()) {
            return $this->respond([
                'success' => false,
                'message' => 'NPK atau Password Salah'
            ], 401);
        }

        if (! password_verify($password, $user['password'])) {
            return $this->respond([
                'success' => false,
                'message' => 'NPK atau Password Salah'
            ], 401);
        }

        // JWT creation
        $issuedAt   = time();
        $ttl        = (int) env('JWT_TTL', 3600);
        $expire     = $issuedAt + $ttl;
        $secretKey  = env('JWT_SECRET');

        $payload = [
            'iat'  => $issuedAt,           // Issued at: time when the token was generated
            'exp'  => $expire,             // Expiration time
            'sub'  => $user['npk'],         // Subject (user ID)
            'npk'  => $user['npk'],        // custom claim
            'role' => $user['role'],       // custom claim
        ];

        $jwt = JWT::encode($payload, $secretKey, 'HS256');

        return $this->respond([
            'success'    => true,
            'message'    => 'Login Berhasil',
            'access_token' => $jwt,
            'token_type'   => 'Bearer',
            'expires_in'   => $ttl
        ], 200);
    }
    public function download()
    {
        $json = $this->request->getJSON();

        if (! $json || ! isset($json->npk)) {
            return $this->respond([
                'success' => false,
                'message' => 'Invalid JSON request. NPK is required.'
            ], 400);
        }

        $npk = $json->npk;

        $lokasiModel = new MasterLokasiModel();
        $karyawanModel = new KaryawanModel();
        $groupModel = new GroupModel();
        $rfidGroupModel = new RfidGroupModel();
        $usersModel = new UsersModel();
        $policyModel = new PolicyModel();
        $masterLossesModel = new MasterLossesModel();
        $ptEstateModel = new PtEstateModel();
        $masterBlokModel = new MasterBlokModel();
        $statusModel = new StatusModel();
        $hectareStatementModel = new HectareStatementModel();
        $timbanganModel = new TimbanganModel();
        $tanamanModel = new TanamanModel();

        $data = [
            'lokasi' => $lokasiModel->findAll(),
            'karyawan' => $karyawanModel->where('npk', $npk)->first(),
            'group' => $groupModel->findAll(),
            'rfid_group' => $rfidGroupModel->findAll(),
            'users' => $usersModel->findAll(),
            'policy' => $policyModel->findAll(),
            'master_losses' => $masterLossesModel->findAll(),
            'pt_estate' => $ptEstateModel->findAll(),
            'master_blok' => $masterBlokModel->findAll(),
            'status' => $statusModel->findAll(),
            'hectare_statement' => $hectareStatementModel->findAll(),
            'timbangan' => $timbanganModel->findAll(),
            'tanaman' => $tanamanModel->findAll(),
        ];

        return $this->respond([
            'success' => true,
            'message' => 'Data berhasil diunduh.',
            'data' => $data
        ], 200);
    }
}
