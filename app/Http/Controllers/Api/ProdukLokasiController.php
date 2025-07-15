<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class ProdukLokasiController extends Controller
{
  public function index()
    {
        return response()->json(ProdukLokasi::with(['produk', 'lokasi'])->get());
    }

    public function show(ProdukLokasi $produkLokasi)
    {
        return response()->json($produkLokasi->load(['produk', 'lokasi', 'mutasi']));
    }

    public function update(Request $request, ProdukLokasi $produkLokasi)
    {
        $validated = $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produkLokasi->update(['stok' => $validated['stok']]);

        return response()->json($produkLokasi);
    }
}
