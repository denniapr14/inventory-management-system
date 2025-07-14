<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'alamat',
        'pic'
    ];

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class, 'produk_lokasi')
                    ->withPivot('stok', 'id')
                    ->withTimestamps();
    }
}
