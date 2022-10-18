<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_name', 'product_stock', 'product_price'];

    protected $validationRules      = [
        'user_id' => 'required',
        'product_name' => 'required',
        'product_stock' => 'required',
        'product_price' => 'required'
    ];
    protected $validationMessages   = [
        'user_id' => [
            'required' => 'User id harus diisi!'
        ],
        'product_name' => [
            'required' => 'Nama produk harus diisi!'
        ],
        'product_stock' => [
            'required' => 'Stok produk harus diisi!'
        ],
        'product_price' => [
            'required' => 'Harga produk harus diisi!'
        ],
    ];
}