<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class User extends BaseController
{
    use ResponseTrait;
    
    public function index()
    {
        //
    }

    public function create()
    {
        $this->model = new UserModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp')
        ];

        $success = $this->model->save($data);
        if(!$success)
        {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil registrasi'
            ]
        ];

        return $this->respond($response);
    }

    public function login()
    {
        $this->model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userData = $this->model->where([
            'email' => $email
        ])->first();

        if($userData)
        {
            if(password_verify($password, $userData["password"]))
            {
                helper('jwt');
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => [
                        'success' => 'Berhasil login'
                    ],
                    'token' => createdJWT($userData["id"])
                ];

                return $this->respond($response);
            }
            else{
                return $this->failNotFound("Email atau password salah");
            }
        }
    }
}
