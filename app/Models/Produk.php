<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kode_produk',
        'kategori',
        'satuan',
        'deskripsi',
        'harga'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function lokasi(): BelongsToMany
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasi')
                    ->withPivot('stok', 'id')
                    ->withTimestamps();
    }

    public function mutasi(): HasManyThrough
    {
        return $this->hasManyThrough(
            Mutasi::class,
            ProdukLokasi::class,
            'produk_id',
            'produk_lokasi_id',
            'id',
            'id'
        );
    }
}
