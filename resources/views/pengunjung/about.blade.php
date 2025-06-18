@extends('layout.app_pengunjung')

@section('title', 'Tentang Museum')
@section('body_class', 'halaman-bergambar')

@section('konten')
<div class="about-wrapper" style="background: url('{{ asset('images/museum-profil.jpg') }}') no-repeat center center fixed; background-size: cover; min-height: 100vh; padding: 60px 15px; display: flex; justify-content: center; align-items: center;">
    <div class="bg-glass">
        <h3 class="mb-4 fw-bold text-center">
            <i class="bi bi-bank2 me-2"></i> Tentang Museum Sejarah Nasional
        </h3>

        <p class="about-text">
            Museum Sejarah Nasional Indonesia adalah pusat informasi sejarah yang didedikasikan untuk memperkenalkan perjalanan bangsa Indonesia kepada masyarakat luas. Museum ini menyajikan berbagai koleksi peninggalan bersejarah, mulai dari masa kolonial, era perjuangan kemerdekaan, hingga berdirinya Republik Indonesia.
        </p>

        <p class="about-text">
            Melalui fitur <strong>Jelajahi Koleksi</strong>, pengunjung dapat menelusuri berbagai objek bersejarah yang menggambarkan identitas dan perjuangan bangsa. Sedangkan melalui bagian <strong>Berita Terbaru</strong>, pengunjung dapat mengikuti informasi dan wacana aktual seputar sejarah, kebudayaan, dan perkembangan museum di Indonesia.
        </p>

        <p class="about-text">
            Museum ini dikembangkan sebagai sarana edukatif yang terbuka bagi pelajar, peneliti, dan masyarakat umum yang ingin memahami akar sejarah Indonesia secara lebih mendalam dan kontekstual.
        </p>
    </div>
</div>

<style>
    .bg-glass {
        background-color: rgba(255, 255, 255, 0.88);
        padding: 2rem 2.5rem;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        width: 100%;
    }

    .about-wrapper h3 i {
        color: #6c63ff;
    }

    .about-text {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #333;
    }
</style>
@endsection
