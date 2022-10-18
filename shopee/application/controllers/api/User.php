<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;


class User extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index_get()
    {
        $user = $this->User_model->getDataUser();
        return $this->response([
            'status' => REST_Controller::HTTP_OK,
            'data' => $user
        ]);
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'alamat' => $this->post('alamat'),
            'no_hp' => $this->post('no_hp')
        ];

        $validator = $this->form_validation;
        $validator->set_rules($this->User_model->rules());

        if($validator->run() == false)
        {
            return $this->response([
                'status' => REST_Controller::HTTP_BAD_REQUEST,
                'message' => $validator->error_array()
            ]);
        }
        else
        {
            $user = $this->User_model->insertDataUser($data);

            if($user)
            {
                return $this->response([
                    'status' => REST_Controller::HTTP_OK,
                    'message' => 'success insert data!'
                ]);
            }
            else{
                return $this->response([
                    'status' => REST_Controller::HTTP_BAD_REQUEST,
                    'message' => 'failed insert data!'
                ]);
            }
        }

    }
}