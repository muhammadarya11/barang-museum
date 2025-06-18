@extends('layout.app')

@section('title', 'Kelola Koleksi')

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

    .header-koleksi {
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

    table thead th {
        background-color: #e6b800 !important;
        color: black !important;
        vertical-align: middle;
        text-align: center;
    }

    td > a.btn {
        margin-right: 0.5rem;
    }
</style>

<div class="position-relative" style="min-height: 550px;">
    <div style="position: relative; z-index: 1;">
        <div class="header-koleksi">
            <h4 class="text-white m-0">Kelola Koleksi</h4>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('/tambah-koleksi') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah Koleksi
                </a>

                <form action="{{ route('koleksi-barang') }}" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" name="cari" class="search-input" placeholder="Cari Koleksi" value="{{ request('cari') }}">
                </form>
            </div>
        </div>

        <table class="table table-bordered bg-white rounded">
            <thead>
                <tr>
                    <th style="width: 6%;">Id Koleksi</th>
                    <th style="width: 20%;">Nama Koleksi</th>
                    <th style="width: 13%;">Asal koleksi</th>
                    <th style="width: 10%;">Tahun</th>
                    <th style="width: 10%;">Deskripsi</th>
                    <th style="width: 12%;">Kategori</th>
                    <th style="width: 12%;">Lokasi</th>
                    <th style="width: 12%;">Gambar</th>
                    <th style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php
                        $formattedId = 'ID' . str_pad($item->id_koleksi, 3, '0', STR_PAD_LEFT);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $formattedId }}</td>
                        <td>{{ $item->nama_koleksi }}</td>
                        <td>{{ $item->asal_koleksi }}</td>
                        <td class="text-center">{{ $item->tahun_perolehan }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->lokasi ? $item->lokasi->nama_lokasi : '-' }}</td>
                        <td class="text-center">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" style="width: 50px; height: auto;">
                            @else
                                <em class="text-muted">Tidak ada gambar</em>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('koleksi.edit', $item->id_koleksi) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('koleksi.hapus', $item->id_koleksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
