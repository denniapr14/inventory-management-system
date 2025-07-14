@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Produk</h5>
                        <h2 class="mb-0">{{ $stats['total_produk'] }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Lokasi</h5>
                        <h2 class="mb-0">{{ $stats['total_lokasi'] }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Mutasi</h5>
                        <h2 class="mb-0">{{ $stats['total_mutasi'] }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-exchange-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card card-stats bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mutasi Terbaru</h5>
            </div>
            <div class="card-body">
                @if($recentMutasi->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentMutasi as $mutasi)
                                <tr>
                                    <td>{{ $mutasi->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ $mutasi->produkLokasi->produk->nama_produk }}</td>
                                    <td>{{ $mutasi->produkLokasi->lokasi->nama_lokasi }}</td>
                                    <td>
                                        <span class="badge bg-{{ $mutasi->jenis_mutasi == 'masuk' ? 'success' : 'danger' }}">
                                            {{ ucfirst($mutasi->jenis_mutasi) }}
                                        </span>
                                    </td>
                                    <td>{{ $mutasi->jumlah }}</td>
                                    <td>{{ $mutasi->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada mutasi</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
