@extends('layouts.app')

@section('title', 'Mutasi')
@section('page-title', 'Data Mutasi')

@section('page-actions')
<a href="{{ route('mutasi.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Mutasi
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if($mutasi->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mutasi as $item)
                        <tr>
                            <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $item->produkLokasi->produk->nama_produk }}</td>
                            <td>{{ $item->produkLokasi->lokasi->nama_lokasi }}</td>
                            <td>
                                <span class="badge bg-{{ $item->jenis_mutasi == 'masuk' ? 'success' : 'danger' }}">
                                    {{ ucfirst($item->jenis_mutasi) }}
                                </span>
                            </td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->keterangan ?: '-' }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mutasi.show', $item) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('mutasi.edit', $item) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mutasi.destroy', $item) }}" method="POST" class="d-inline">
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
                <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                <h5>Belum ada mutasi</h5>
                <p class="text-muted">Klik tombol "Tambah Mutasi" untuk menambah mutasi baru</p>
            </div>
        @endif
    </div>
</div>
@endsection
