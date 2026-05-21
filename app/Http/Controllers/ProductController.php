<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // 1. TAMPILKAN DATA (Index)
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar produk berhasil diambil',
            'data' => $products
        ], 200);
    }

    // 2. TAMBAH DATA (Store) - Menggunakan Validation, Error Handling, dan Service
    public function store(StoreProductRequest $request)
    {
        // Validasi otomatis berjalan di sini lewat StoreProductRequest
        $validatedData = $request->validated();

        try {
            // Memanggil fungsi dari Service Layer
            $product = $this->productService->storeProduct($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan!',
                'data' => $product
            ], 201);

        } catch (Exception $e) {
            // Menangkap error jika proses di Service gagal
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. UBAH DATA (Update)
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $product->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ], 200);
    }

    // 4. HAPUS DATA (Destroy)
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }

    public function show($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Data produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail produk berhasil diambil',
            'data' => $product
        ], 200);
    }
}