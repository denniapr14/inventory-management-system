<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutasi extends Model
{
    protected $table = 'mutasi';

    protected $fillable = [
        'tanggal',
        'jenis_mutasi',
        'jumlah',
        'keterangan',
        'user_id',
        'produk_lokasi_id'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produkLokasi(): BelongsTo
    {
        return $this->belongsTo(ProdukLokasi::class);
    }

    protected static function booted()
    {
        static::created(function ($mutasi) {
            $produkLokasi = $mutasi->produkLokasi;

            if ($mutasi->jenis_mutasi === 'masuk') {
                $produkLokasi->increment('stok', $mutasi->jumlah);
            } else {
                $produkLokasi->decrement('stok', $mutasi->jumlah);
            }
        });

        static::updated(function ($mutasi) {
            $produkLokasi = $mutasi->produkLokasi;
            $original = $mutasi->getOriginal();

            // Revert original changes
            if ($original['jenis_mutasi'] === 'masuk') {
                $produkLokasi->decrement('stok', $original['jumlah']);
            } else {
                $produkLokasi->increment('stok', $original['jumlah']);
            }

            // Apply new changes
            if ($mutasi->jenis_mutasi === 'masuk') {
                $produkLokasi->increment('stok', $mutasi->jumlah);
            } else {
                $produkLokasi->decrement('stok', $mutasi->jumlah);
            }
        });

        static::deleted(function ($mutasi) {
            $produkLokasi = $mutasi->produkLokasi;

            // Revert the mutation
            if ($mutasi->jenis_mutasi === 'masuk') {
                $produkLokasi->decrement('stok', $mutasi->jumlah);
            } else {
                $produkLokasi->increment('stok', $mutasi->jumlah);
            }
        });
    }
}
