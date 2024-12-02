<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $perPage = $request->query('per_page', 5); // Default per halaman 5

        $keyword = $request->query('keyword', '');

        $brands = Brand::where('brand_name', 'like', "%{$keyword}%")
            ->orderBy('brand_name', 'desc')
            ->paginate(10);

        // return response()->json(['brands' => $brands]);
        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'brand_name' => 'required|string',
        ], [
            'brand_name.required' => 'Nama brand wajib diisi.',
        ]);
        Brand::create($request->all());
        return response()->json(['message' => 'Brand berhasil disimpan'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $brands = Brand::findOrFail($id);
        return response()->json($brands);

        // if ($brands) {
        //     return response()->json(['brand' => $brands]);
        // } else {
        //     return response()->json(['message' => 'Brand tidak ditemukan'], 404);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'brand_name' => 'required',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        return response()->json(['message' => 'Brand berhasil diupdate'], 200);

        // if(!$brand) {
        //     return response()->json(['message'=>'Brand tidak ditemukan'], 404);
        // }

        // $brand->update($validateData);
        // return response()->json(['message' => 'Brand berhasil diupdate', 'brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = Brand::findOrFail($id);

        // if(!$brand) {
        //     return response()->json(['message' => 'Brand tidak ditemukan'], 404);
        // }

        $brand->delete();
        return response()->json(['message' => 'Brand berhasil dihapus']);
    }
}