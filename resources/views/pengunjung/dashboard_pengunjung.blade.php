@extends('layout.app_pengunjung')

@section('title', 'Beranda Pengunjung')

@section('konten')

<style>
    .koleksi-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .koleksi-card:hover,
    .berita-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
</style>

<div class="container-fluid px-0">
    <div class="position-relative" style="height: 60vw; max-height: 480px; overflow: hidden;">
        <img src="{{ asset('images/dashboard.jpg') }}" 
             alt="DIGIMUSEUM Header"
             style="width: 100%; height: 100%; object-fit: cover; object-position: center; filter: brightness(0.6);">
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
            <h2 class="fw-bold">Selamat Datang di Museum Sejarah Nasional</h2>
            <p class="fs-5 fst-italic">Temukan kekayaan koleksi budaya dan sejarah dari seluruh Nusantara.</p>
        </div>
    </div>
</div>

<div class="container my-5">

    <div class="border rounded p-4 shadow-sm mb-5">
        <h3 class="text-center mb-2"> Jelajahi Koleksi Digital Kami</h3>
        <p class="text-center text-muted mb-4">Temukan berbagai artefak dan warisan budaya Indonesia yang tersimpan dengan baik</p>

        <div class="row justify-content-center">
            @foreach ($koleksi as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                <div class="card w-100 border rounded text-center shadow-sm koleksi-card transition">

                    @if ($item['gambar'])
                        <img src="{{ asset('storage/' . $item['gambar']) }}" 
                             alt="{{ $item['nama_koleksi'] }}" 
                             class="img-fluid rounded-top"
                             style="width: 100%; height: 150px; object-fit: cover;">
                    @else
                        <div class="text-muted" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                            <em>Tidak ada gambar</em>
                        </div>
                    @endif

                    <div class="card-body py-3">
                        <h6 class="fw-bold mb-2 text-dark">{{ $item['nama_koleksi'] }}</h6>
                        <a href="{{ route('detail.koleksi', ['id' => $item['id_koleksi']]) }}" 
                           class="btn btn-sm btn-outline-primary fw-semibold">
                             Lihat Detail
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

    <h3 class="text-center mb-4"> Berita dan Kegiatan Terbaru</h3>
    <div class="row">
        @foreach ($berita as $item)
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card shadow-sm flex-md-row flex-column align-items-center h-100 berita-card border rounded transition">
                <img src="{{ asset('images/' . $item['gambar']) }}"
                     alt="{{ $item['judul'] }}"
                     style="width: 180px; height: 120px; object-fit: cover;"
                     class="img-fluid rounded-start m-3">

                <div class="card-body p-3">
                    <h5 class="card-title fw-bold mb-1 text-dark">{{ $item['judul'] }}</h5>
                    <p class="text-muted small mb-1">{{ $item['tanggal'] }}</p>
                    <p class="card-text small">{{ Str::limit($item['deskripsi'], 100) }}</p>
                    <a href="{{ $item['link'] }}" target="_blank" class="btn btn-sm btn-outline-primary fw-semibold">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
