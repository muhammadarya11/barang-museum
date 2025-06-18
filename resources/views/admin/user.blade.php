@extends('layout.app')

@section('title', 'User')

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

    .header-user {
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

    td > a.btn {
        margin-right: 0.5rem;
    }
</style>

<div class="content-wrapper position-relative" style="min-height: 550px;">
    <div style="position: relative; z-index: 1;">

        <div class="header-user">
            <h4 class="text-white m-0">Data User</h4>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('user/tambah') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah User
                </a>

                <form action="{{ route('user.index') }}" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="search" name="cari" class="search-input" placeholder="Cari User" value="{{ request('cari') }}">
                </form>
            </div>
        </div>

        <table class="table table-bordered bg-white rounded">
            <thead>
                <tr>
                    <th style="width: 8%;">ID User</th>
                    <th style="width: 20%;">Nama</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 15%;">Role</th>
                    <th style="width: 20%;">Password</th>
                    <th style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ $user->role }}</td>
                        <td class="text-center">
                            <em>********</em>
                            <a href="{{ route('user.reset_password', $user->id) }}" class="btn btn-sm btn-warning ms-2 btn-icon-sm" title="Reset Password">
                                <i class="fa fa-key"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-primary btn-icon-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                        <form action="{{ route('user.hapus', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus user ini?')">
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
                        <td colspan="6" class="text-center">Tidak ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
