<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class ProdukLokasiController extends Controller
{
    public function index()
    {
        $produkLokasi = ProdukLokasi::with(['produk', 'lokasi'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $produkLokasi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'stok' => 'required|integer|min:0',
        ]);

        $produkLokasi = ProdukLokasi::create($request->all());
        $produkLokasi->load(['produk', 'lokasi']);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk Lokasi created successfully',
            'data' => $produkLokasi
        ], 201);
    }

    public function show(ProdukLokasi $produkLokasi)
    {
        $produkLokasi->load(['produk', 'lokasi', 'mutasi.user']);

        return response()->json([
            'status' => 'success',
            'data' => $produkLokasi
        ]);
    }

    public function update(Request $request, ProdukLokasi $produkLokasi)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produkLokasi->update($request->only('stok'));
        $produkLokasi->load(['produk', 'lokasi']);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk Lokasi updated successfully',
            'data' => $produkLokasi
        ]);
    }

    public function destroy(ProdukLokasi $produkLokasi)
    {
        $produkLokasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk Lokasi deleted successfully'
        ]);
    }
}
