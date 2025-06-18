@extends('layout.app_pengunjung')

@section('title', 'Koleksi Pengunjung')
@section('body_class', 'halaman-bergambar')

@section('konten')
<style>
    .header-koleksi {
        background-color: #00BB00;
        border-radius: 12px;
        padding: 12px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px auto;
        max-width: 1000px;
        width: 95%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        flex-wrap: wrap;
        gap: 10px;
    }

    .header-koleksi h4 {
        color: white;
        font-weight: bold;
        font-size: 1.3rem;
        margin: 0;
    }

    .search-box {
        display: flex;
        align-items: center;
        border-radius: 20px;
        background-color: white;
        padding: 5px 12px;
        border: 1px solid #ccc;
        width: 100%;
        max-width: 260px;
    }

    .search-box input {
        border: none;
        outline: none;
        font-size: 14px;
        width: 100%;
        background-color: transparent;
        margin-left: 8px;
    }

    .search-box button {
        border: none;
        background: transparent;
        color: black;
        display: flex;
        align-items: center;
    }

    .koleksi-img {
        width: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .table thead th {
        background-color: #F5C518;
        color: #000;
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        font-size: 15px;
    }

    .table td {
        vertical-align: middle;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .header-koleksi {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .koleksi-img {
            width: 70px;
        }

        .btn-detail {
            font-size: 12px;
            padding: 4px 10px;
        }

        .table td, .table th {
            font-size: 13px;
        }
    }
</style>

<div class="header-koleksi">
    <h4>Koleksi (pengunjung)</h4>
    <form action="{{ route('koleksi.pengunjung') }}" method="GET" class="search-box">
        <button type="submit"><i class="fa fa-search"></i></button>
        <input type="text" name="cari" placeholder="Cari koleksi..." value="{{ request('cari') }}">
    </form>
</div>

<div class="table-responsive bg-white shadow-sm" style="max-width: 1000px; width: 95%; margin: 0 auto 60px auto; border-radius: 12px;">
    <table class="table table-bordered text-center mb-0">
        <thead>
            <tr>
                <th style="width: 160px;">Gambar Koleksi</th>
                <th>Nama Koleksi</th>
                <th style="width: 100px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($koleksi as $item)
                <tr>
                    <td><img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_koleksi }}" class="koleksi-img"></td>
                    <td class="align-middle">{{ $item->nama_koleksi }}</td>
                    <td class="align-middle">
                        <button class="btn btn-sm btn-primary btn-detail"
                            data-bs-toggle="modal"
                            data-bs-target="#modalKoleksi"
                            data-nama="{{ e($item->nama_koleksi) }}"
                            data-asal="{{ e($item->asal_koleksi ?? '-') }}"
                            data-tahun="{{ e($item->tahun_perolehan ?? '-') }}"
                            data-kategori="{{ e($item->kategori ?? '-') }}"
                            data-deskripsi="{{ e($item->deskripsi ?? 'Deskripsi belum tersedia') }}"
                            data-gambar="{{ asset('storage/' . $item->gambar) }}">
                            Detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('modals')
<div class="modal fade" id="modalKoleksi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content text-center p-3" style="max-width: 500px; margin: auto;">
      <img id="modalGambar" src="" alt="Gambar Koleksi" class="img-fluid mb-3 rounded" style="max-height: 200px; object-fit: contain;">
      <h5 id="modalNama" class="fw-bold"></h5>
      <p><strong>Kategori:</strong> <span id="modalKategori"></span></p>
      <p><strong>Asal:</strong> <span id="modalAsal"></span></p>
      <p><strong>Tahun:</strong> <span id="modalTahun"></span></p>
      <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
      <button class="btn btn-secondary mt-2" data-bs-dismiss="modal">Kembali</button>
    </div>
  </div>
</div>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('modalNama').innerText = button.getAttribute('data-nama');
            document.getElementById('modalAsal').innerText = button.getAttribute('data-asal');
            document.getElementById('modalTahun').innerText = button.getAttribute('data-tahun');
            document.getElementById('modalKategori').innerText = button.getAttribute('data-kategori');
            document.getElementById('modalDeskripsi').innerText = button.getAttribute('data-deskripsi');
            document.getElementById('modalGambar').src = button.getAttribute('data-gambar');
        });
    });
});
</script>
@endpush
