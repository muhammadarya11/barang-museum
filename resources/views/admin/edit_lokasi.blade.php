@extends('layout.app')

@section('title', 'Edit Lokasi')

@section('konten')

<style>
    .fullscreen-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: url('{{ asset('images/museumm.jpeg') }}') no-repeat center center fixed;
        background-size: cover;
        z-index: -1;
    }

    .centered-card {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative;
        z-index: 1;
        padding: 20px;
    }

    .form-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 32px 48px;
        max-width: 700px;
        width: 100%;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="fullscreen-bg"></div>

<div class="centered-card">
    <div class="form-card">
        <h3 class="text-center mb-4">Edit Lokasi</h3>

        <form action="{{ route('lokasi-barang.update', $lokasi->id_lokasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control"
                    value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}" required>
                @error('nama_lokasi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('lokasi-barang') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
