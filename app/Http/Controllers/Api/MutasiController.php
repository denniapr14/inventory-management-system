<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $mutasi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'produk_lokasi_id' => 'required|exists:produk_lokasi,id',
        ]);

        // Check if stock is sufficient for 'keluar' mutation
        if ($request->jenis_mutasi === 'keluar') {
            $produkLokasi = ProdukLokasi::find($request->produk_lokasi_id);
            if ($produkLokasi->stok < $request->jumlah) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $produkLokasi->stok
                ], 422);
            }
        }

        $mutasi = Mutasi::create([
            'tanggal' => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
            'produk_lokasi_id' => $request->produk_lokasi_id,
        ]);

        $mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']);

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi created successfully',
            'data' => $mutasi
        ], 201);
    }

    public function show(Mutasi $mutasi)
    {
        $mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']);

        return response()->json([
            'status' => 'success',
            'data' => $mutasi
        ]);
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'produk_lokasi_id' => 'required|exists:produk_lokasi,id',
        ]);

        $mutasi->update($request->all());
        $mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']);

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi updated successfully',
            'data' => $mutasi
        ]);
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi deleted successfully'
        ]);
    }

    public function userHistory(Request $request)
    {
        $mutasi = Mutasi::where('user_id', auth()->id())
                        ->with(['produkLokasi.produk', 'produkLokasi.lokasi'])
                        ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => auth()->user(),
                'mutasi' => $mutasi
            ]
        ]);
    }
}
