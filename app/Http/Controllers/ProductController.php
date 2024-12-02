<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $perPage = $request->query('per_page', 5); // Default per halaman 5

        $keyword = $request->query('keyword', '');

        $products = Product::with(['brand', 'category'])
            ->where('name', 'like', "%{$keyword}%")
            ->orWhereHas('brand', function ($query) use ($keyword) {
                $query->where('brand_name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('category_name', 'like', "%{$keyword}%");
            })
            ->orWhere('price', 'like', "%{$keyword}%")
            ->orWhere('stock', 'like', "%{$keyword}%")
            ->orderBy('category_id', 'asc')
            ->paginate(10);

        $products->getCollection()->transform(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'brand_name' => $product->brand->brand_name,
                'category_name' => $product->category->category_name,
                'price' => $product->price,
                'stock' => $product->stock,
            ];
        });

        // return response()->json(['products' => $products]);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,id', 
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'brand_id.exists' => 'Brand yang dipilih tidak valid.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
        ]);
        Product::create($request->all());
        return response()->json(['message' => 'Produk berhasil disimpan'], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $products = Product::findOrFail($id);
        return response()->json($products);

        // if ($products) {
        //     return response()->json(['product' => $products]);
        // } else {
        //     return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'brand_id' => 'sometimes|exists:brands,id',
            'category_id' => 'sometimes|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
        $product->update($request->all());
        return response()->json([
            'message' => 'Produk berhasil diperbarui.',
        ], 200);

        // if(!$product) {
        //     return response()->json(['message'=>'Produk tidak ditemukan'], 404);
        // }

        // $product->update($validateData);
        // return response()->json(['message' => 'Produk berhasil diupdate', 'product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);

        // if(!$product) {
        //     return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        // }

        $product->delete();
        return response()->json([
            'message' => 'Produk berhasil dihapus.',
        ], 200);
    }
}   