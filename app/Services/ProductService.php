<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function storeProduct(array $data)
    {
        try {
            return Product::create($data);
        } catch (Exception $e) {
            Log::error('Gagal menambahkan produk: ' . $e->getMessage());
            
            throw new Exception('Terjadi kesalahan pada server saat menyimpan data.');
        }
    }
}