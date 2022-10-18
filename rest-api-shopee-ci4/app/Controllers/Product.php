<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
 
class Product extends ResourceController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ProductModel();
    }
    
    public function index()
    {
        // $this->model = new ProductModel();
        $data = $this->model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data, 200);
    }
    
    // create
    public function create()
    {
        // $this->model = new ProductModel();
        // $data = [
        //     'user_id' => $this->request->getVar('user_id'),
        //     'product_name' => $this->request->getVar('product_name'),
        //     'product_stock'  => $this->request->getVar('product_stock'),
        //     'product_price'  => $this->request->getVar('product_price'),
        // ];
        $data = $this->request->getPost();
        $this->model->insert($data);
        $response = [
            'status'   => 200,
            'messages' => 'Data produk berhasil ditambahkan.'
        ];
        return $this->respondCreated($response);
    }
    
    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        // $this->model = new ProductModel();
        $isExists = $this->model->where('id', $id)->findAll();
        if(!$isExists)
        {
            return $this->failNotFound("Data tidak di temukan untuk id $id");
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $success = $this->model->save($data);
        if(!$success)
        {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil update data produk'
            ]
        ];

        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        // $this->model = new ProductModel();
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'message' => "Data produk berhasil dihapus."
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data produk tidak ditemukan.');
        }
    }
}