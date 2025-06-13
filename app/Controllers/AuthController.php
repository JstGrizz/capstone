<?php

namespace App\Controllers;


use App\Models\UsersModel;
use App\Models\karyawanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AuthController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';

    public function login()
    {
        return view('auth-login');
    }

    public function register()
    {
        return view('auth-register');
    }

    public function registerProcess()
    {
        $model = new UsersModel();
        $karyawanModel = new karyawanModel();

        $username = $this->request->getPost('username');
        $npk = $this->request->getPost('npk');
        $password = $this->request->getPost('password');

        // First check if the NPK is available
        if (!$karyawanModel->where('npk', $npk)->first()) {
            return $this->respond([
                'success' => false,
                'message' => 'NPK tidak terdaftar : ' . $npk
            ], 400);
        }

        // Check if user or NPK already exists
        if ($model->where('username', $username)->first() || $model->where('npk', $npk)->first()) {
            return $this->respond([
                'success' => false,
                'message' => 'Username atau NPK sudah digunakan'
            ], 409); // Use 409 Conflict for existing resource
        }

        $data = [
            'username' => $username,
            'npk' => $npk,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        try {
            $model->save($data);
            return $this->respondCreated([
                'success' => true,
                'message' => 'Pendaftaran berhasil'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Pendaftaran gagal: ' . $e->getMessage()
            ], 500); // Use 500 Internal Server Error for database errors
        }
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UsersModel();
        $json = $this->request->getJSON();

        if ($json === null) {
            return $this->respond([
                'success' => false,
                'message' => 'Invalid JSON data provided.'
            ], 400);
        }

        $npk = $json->npk ?? null;
        $password = $json->password ?? null;

        if (empty($npk) || empty($password)) {
            return $this->respond([
                'success' => false,
                'message' => 'NPK dan Password harus diisi.'
            ], 400);
        }

        $user = $model->where('npk', $npk)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set user session
            $sessionData = [
                'npk' => $user['npk'],
                'isLoggedIn' => true
            ];
            $session->set($sessionData);
            return $this->respond([
                'success' => true,
                'message' => 'Login Berhasil'
            ], 200);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'NPK atau Password Salah'
            ], 401); // Use 401 Unauthorized
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth-login'));
    }
}
