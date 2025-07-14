@extends('layouts.app')

@section('title', 'Edit Mutasi')
@section('page-title', 'Edit Mutasi')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('mutasi.update', $mutasi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                               id="tanggal" name="tanggal" value="{{ old('tanggal', $mutasi->tanggal->format('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="produk_lokasi_id" class="form-label">Produk & Lokasi</label>
                        <select class="form-select @error('produk_lokasi_id') is-invalid @enderror"
                                id="produk_lokasi_id" name="produk_lokasi_id" required>
                            @foreach($produkLokasi as $item)
                                <option value="{{ $item->id }}" {{ old('produk_lokasi_id', $mutasi->produk_lokasi_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->produk->nama_produk }} - {{ $item->lokasi->nama_lokasi }} (Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('produk_lokasi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_mutasi" class="form-label">Jenis Mutasi</label>
                                <select class="form-select @error('jenis_mutasi') is-invalid @enderror"
                                        id="jenis_mutasi" name="jenis_mutasi" required>
                                    <option value="masuk" {{ old('jenis_mutasi', $mutasi->jenis_mutasi) == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ old('jenis_mutasi', $mutasi->jenis_mutasi) == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                                @error('jenis_mutasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                       id="jumlah" name="jumlah" value="{{ old('jumlah', $mutasi->jumlah) }}" min="1" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $mutasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mutasi.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
