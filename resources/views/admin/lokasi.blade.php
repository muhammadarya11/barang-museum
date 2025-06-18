@extends('layout.app')

@section('title', 'Kelola Lokasi')

@section('konten')

<div class="fullscreen-bg"></div>

<style>
    .fullscreen-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: url('{{ asset('images/museumm.jpeg') }}') no-repeat center center;
        background-size: cover;
        z-index: -1;
    }

    .header-lokasi {
        background-color: #00BB00;
        border-radius: 12px;
        opacity: 0.9;
        padding: 12px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-box {
        background-color: white;
        border-radius: 20px;
        padding: 5px 10px;
        height: 38px;
        width: 220px;
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
    }

    .search-box .search-icon {
        color: black;
        font-size: 16px;
        margin-right: 8px;
    }

    .search-input {
        border: none;
        outline: none;
        font-size: 14px;
        width: 100%;
    }

    .btn-icon-sm {
        border-radius: 4px;
        padding: 4px 8px;
        min-width: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    table thead th {
        background-color: #e6b800 !important;
        color: black !important;
        vertical-align: middle;
        text-align: center;
    }
</style>

<div class="position-relative" style="min-height: 550px;">
    <div style="position: relative; z-index: 1;">

        <div class="header-lokasi">
            <h4 class="text-white m-0">Kelola Lokasi</h4>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('lokasi-barang.tambah') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah Lokasi
                </a>

                <form action="{{ route('lokasi-barang') }}" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="search" name="cari" class="search-input" placeholder="Cari Lokasi" value="{{ request('cari') }}">
                </form>
            </div>
        </div>

        <table class="table table-bordered bg-white rounded">
            <thead>
                <tr>
                    <th class="text-center">ID Lokasi</th>
                    <th style="width: 25%;">Nama Lokasi</th>
                    <th style="width: 45%;">Deskripsi</th>
                    <th style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ 'LB' . str_pad($item->id_lokasi, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->nama_lokasi }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">

                                <a href="{{ route('lokasi.edit', $item->id_lokasi) }}" 
                                   class="btn btn-sm btn-outline-primary btn-icon-sm" 
                                   title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('lokasi.hapus', $item->id_lokasi) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus lokasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-icon-sm" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data lokasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
