@extends('layout.app')

@section('title', 'Edit Laporan')

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
        <h3 class="text-center mb-4">Edit Laporan</h3>

        <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_laporan" class="form-label">ID Laporan</label>
                <input type="text" id="id_laporan" class="form-control" value="{{ $laporan->id_laporan }}" disabled>
                <small class="text-muted">ID Laporan tidak dapat diubah.</small>
            </div>

            <div class="mb-3">
                <label for="judul_laporan" class="form-label">Judul Laporan</label>
                <input type="text" name="judul" id="judul_laporan" class="form-control" value="{{ old('judul', $laporan->judul_laporan) }}" required>
                @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_laporan" class="form-label">Tanggal Laporan</label>
                <input type="date" name="tanggal" id="tanggal_laporan" class="form-control"
                    value="{{ old('tanggal', \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('Y-m-d')) }}" required>
                @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="file_laporan" class="form-label">File Laporan (PDF/DOC) - Opsional</label>
                <input type="file" class="form-control" id="file_laporan" name="file_laporan" accept=".pdf,.doc,.docx">
                @if ($laporan->file_laporan)
                    <small>File saat ini: 
                        <a href="{{ asset('uploads/laporan/' . $laporan->file_laporan) }}" target="_blank">
                            {{ $laporan->file_laporan }}
                        </a>
                    </small>
                @endif
                @error('file_laporan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('laporan-statistik') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
