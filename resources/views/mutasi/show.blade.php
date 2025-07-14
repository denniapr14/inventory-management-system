@extends('layouts.app')

@section('title', 'Detail Mutasi')
@section('page-title', 'Detail Mutasi')

@section('page-actions')
<a href="{{ route('mutasi.edit', $mutasi) }}" class="btn btn-warning">
    <i class="fas fa-edit"></i> Edit
</a>
<a href="{{ route('mutasi.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Mutasi</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>{{ $mutasi->tanggal->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Produk</strong></td>
                        <td>{{ $mutasi->produkLokasi->produk->nama_produk }} ({{ $mutasi->produkLokasi->produk->kode_produk }})</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>{{ $mutasi->produkLokasi->lokasi->nama_lokasi }} ({{ $mutasi->produkLokasi->lokasi->kode_lokasi }})</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Mutasi</strong></td>
                        <td>
                            <span class="badge bg-{{ $mutasi->jenis_mutasi == 'masuk' ? 'success' : 'danger' }}">
                                {{ ucfirst($mutasi->jenis_mutasi) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah</strong></td>
                        <td>{{ $mutasi->jumlah }} {{ $mutasi->produkLokasi->produk->satuan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stok Saat Ini</strong></td>
                        <td>{{ $mutasi->produkLokasi->stok }} {{ $mutasi->produkLokasi->produk->satuan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Keterangan</strong></td>
                        <td>{{ $mutasi->keterangan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>User</strong></td>
                        <td>{{ $mutasi->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat</strong></td>
                        <td>{{ $mutasi->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate</strong></td>
                        <td>{{ $mutasi->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
