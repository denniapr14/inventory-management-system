<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\ProdukLokasi;
use App\Models\Mutasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@inventory.com',
            'password' => Hash::make('password'),
        ]);

        // Create sample products
        $produk1 = Produk::create([
            'nama_produk' => 'Laptop Dell Inspiron',
            'kode_produk' => 'LT001',
            'kategori' => 'Elektronik',
            'satuan' => 'Unit',
            'harga' => 8500000,
            'deskripsi' => 'Laptop Dell Inspiron 15 inch'
        ]);

        $produk2 = Produk::create([
            'nama_produk' => 'Mouse Wireless Logitech',
            'kode_produk' => 'MS001',
            'kategori' => 'Aksesoris',
            'satuan' => 'Pcs',
            'harga' => 350000,
            'deskripsi' => 'Mouse wireless Logitech M705'
        ]);

        // Create sample locations
        $lokasi1 = Lokasi::create([
            'kode_lokasi' => 'GD001',
            'nama_lokasi' => 'Gudang Utama',
            'alamat' => 'Jl. Industri No. 123, Malang',
            'pic' => 'Budi Santoso'
        ]);

        $lokasi2 = Lokasi::create([
            'kode_lokasi' => 'TK001',
            'nama_lokasi' => 'Toko Cabang 1',
            'alamat' => 'Jl. Raya Malang No. 456',
            'pic' => 'Siti Nurhaliza'
        ]);

        // Create product-location relationships
        $produkLokasi1 = ProdukLokasi::create([
            'produk_id' => $produk1->id,
            'lokasi_id' => $lokasi1->id,
            'stok' => 0
        ]);

        $produkLokasi2 = ProdukLokasi::create([
            'produk_id' => $produk2->id,
            'lokasi_id' => $lokasi1->id,
            'stok' => 0
        ]);

        // Create sample mutations
        Mutasi::create([
            'tanggal' => now()->subDays(5),
            'jenis_mutasi' => 'masuk',
            'jumlah' => 10,
            'keterangan' => 'Pembelian awal',
            'user_id' => $admin->id,
            'produk_lokasi_id' => $produkLokasi1->id,
        ]);

        Mutasi::create([
            'tanggal' => now()->subDays(3),
            'jenis_mutasi' => 'masuk',
            'jumlah' => 50,
            'keterangan' => 'Pembelian awal',
            'user_id' => $admin->id,
            'produk_lokasi_id' => $produkLokasi2->id,
        ]);

        Mutasi::create([
            'tanggal' => now()->subDays(1),
            'jenis_mutasi' => 'keluar',
            'jumlah' => 2,
            'keterangan' => 'Penjualan ke customer',
            'user_id' => $admin->id,
            'produk_lokasi_id' => $produkLokasi1->id,
        ]);
    }
}
