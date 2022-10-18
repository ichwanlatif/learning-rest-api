<?php

class User_model extends CI_Model
{
    private $table = 'user';

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required'
            ],
            [
                'field' => 'no_hp',
                'label' => 'Nomor Telepon',
                'rules' => 'required'
            ],
            ];
    }

    public function getDataUser()
    {
        return $this->db->get($this->table)->result();
    }

    public function insertDataUser($data)
    {
        return $this->db->insert($this->table, $data);
    }
}