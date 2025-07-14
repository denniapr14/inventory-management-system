<?php

namespace App\Http\Controllers\Web;

// namespace App\Http\Controllers;
use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\Mutasi;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produk' => Produk::count(),
            'total_lokasi' => Lokasi::count(),
            'total_mutasi' => Mutasi::count(),
            'total_users' => User::count(),
        ];

        $recentMutasi = Mutasi::with(['user', 'produkLokasi.produk', 'produkLokasi.lokasi'])
                             ->latest()
                             ->take(10)
                             ->get();

        return view('dashboard', compact('stats', 'recentMutasi'));
    }
}
