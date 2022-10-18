<?php

namespace App\Models;

use Exception;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'password', 'alamat', 'no_hp'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required'
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Nama harus diisi!'
        ],
        'email' => [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email harus valid!',
            'is_unique' => 'Email sudah terpakai'
        ],
        'password' => [
            'required' => 'Password harus diisi!'
        ],
        'alamat' => [
            'required' => 'Alamat harus diisi!'
        ],
        'no_hp' => [
            'required' => 'No HP harus diisi!'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function validateUser($user_id)
    {
        $builder = $this->table('user');
        $data = $builder->where('id', $user_id)->first();

        if(!$data)
        {
            throw new Exception("User tidak valid!");
        }

        return $data;
    }
}
