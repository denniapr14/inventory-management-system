<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['lokasi'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $produk
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:produk',
            'kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk = Produk::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk created successfully',
            'data' => $produk
        ], 201);
    }

    public function show(Produk $produk)
    {
        $produk->load(['lokasi', 'mutasi.user']);

        return response()->json([
            'status' => 'success',
            'data' => $produk
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255|unique:produk,kode_produk,' . $produk->id,
            'kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk updated successfully',
            'data' => $produk
        ]);
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk deleted successfully'
        ]);
    }

    public function mutasiHistory(Produk $produk)
    {
        $mutasi = $produk->mutasi()->with(['user', 'produkLokasi.lokasi'])->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'produk' => $produk,
                'mutasi' => $mutasi
            ]
        ]);
    }
}
