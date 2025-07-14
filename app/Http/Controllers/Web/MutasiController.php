<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use App\Models\ProdukLokasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])->latest()->get();
        return view('mutasi.index', compact('mutasi'));
    }

    public function create()
    {
        $produkLokasi = ProdukLokasi::with(['produk', 'lokasi'])->get();
        return view('mutasi.create', compact('produkLokasi'));
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
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $produkLokasi->stok]);
            }
        }

        Mutasi::create([
            'tanggal' => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
            'produk_lokasi_id' => $request->produk_lokasi_id,
        ]);

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil ditambahkan');
    }

    public function show(Mutasi $mutasi)
    {
        $mutasi->load(['user', 'produkLokasi.produk', 'produkLokasi.lokasi']);
        return view('mutasi.show', compact('mutasi'));
    }

    public function edit(Mutasi $mutasi)
    {
        $produkLokasi = ProdukLokasi::with(['produk', 'lokasi'])->get();
        return view('mutasi.edit', compact('mutasi', 'produkLokasi'));
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

        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil diupdate');
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil dihapus');
    }
}
