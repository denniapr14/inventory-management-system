@extends('layouts.app')

@section('title', 'Lokasi')
@section('page-title', 'Data Lokasi')

@section('page-actions')
<a href="{{ route('lokasi.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Lokasi
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($lokasi->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Lokasi</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat</th>
                            <th>PIC</th>
                            <th>Total Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokasi as $item)
                        <tr>
                            <td>{{ $item->kode_lokasi }}</td>
                            <td>{{ $item->nama_lokasi }}</td>
                            <td>{{ $item->alamat ?: '-' }}</td>
                            <td>{{ $item->pic ?: '-' }}</td>
                            <td>{{ $item->produk->count() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('lokasi.show', $item) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lokasi.edit', $item) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lokasi.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                <h5>Belum ada lokasi</h5>
                <p class="text-muted">Klik tombol "Tambah Lokasi" untuk menambah lokasi baru</p>
            </div>
        @endif
    </div>
</div>
@endsection
