<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $search = $this->get('search');

        $mahasiswa = $this->mhs->getMahasiswa($id, $search);
        if($mahasiswa)
        {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No mahasiswa were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if($id != null)
        {
            if($this->mhs->deleteMahasiswa($id) > 0)
            {
                //success
                $this->response([
                    'status' => true,
                    'message' => 'success deleted mahasiswa!'
                ], REST_Controller::HTTP_OK); 
            }
            else{
                //failed
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_post()
    {
       $data = [
        'nama' => $this->post('nama'),
        'nim' => $this->post('nim')
       ];

       $mahasiswa = $this->mhs->createMahasiswa($data);
       if($mahasiswa > 0)
       {
        $this->response([
            'status' => true,
            'message' => 'success create mahasiswa'
        ], REST_Controller::HTTP_OK);
       }
       else{
        $this->response([
            'status' => false,
            'message' => 'failed to create mahasiswa'
        ], REST_Controller::HTTP_BAD_REQUEST);
       }

    }

    public function index_put()
    {
       $id = $this->put('id');
       $data = [
        'nama' => $this->put('nama'),
        'nim' => $this->put('nim')
       ];

       $mahasiswa = $this->mhs->updateMahasiswa($data, $id);
       if($mahasiswa > 0)
       {
        $this->response([
            'status' => true,
            'message' => 'success update mahasiswa'
        ], REST_Controller::HTTP_OK);
       }
       else{
        $this->response([
            'status' => false,
            'message' => 'failed to update mahasiswa'
        ], REST_Controller::HTTP_BAD_REQUEST);
       }

    }
}
