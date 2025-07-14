<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::with(['produk'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $lokasi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|max:255|unique:lokasi',
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'pic' => 'nullable|string|max:255',
        ]);

        $lokasi = Lokasi::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi created successfully',
            'data' => $lokasi
        ], 201);
    }

    public function show(Lokasi $lokasi)
    {
        $lokasi->load(['produk']);

        return response()->json([
            'status' => 'success',
            'data' => $lokasi
        ]);
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|max:255|unique:lokasi,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'pic' => 'nullable|string|max:255',
        ]);

        $lokasi->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi updated successfully',
            'data' => $lokasi
        ]);
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi deleted successfully'
        ]);
    }
}
