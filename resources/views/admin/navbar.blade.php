<nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(to right, #3e3e3e, #d3ac7f); padding: 16px 0; position: sticky; top: 0; z-index: 1050;">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-landmark fs-4"></i>
            <span class="fs-5">Museum Sejarah Nasional</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-white fs-4"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="navbarResponsive">
            <ul class="navbar-nav align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="{{ route('koleksi-barang') }}">
                        <i class="fa-solid fa-box-archive"></i> Koleksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="{{ route('lokasi-barang') }}">
                        <i class="fa-solid fa-location-dot"></i> Lokasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="{{ route('laporan-statistik') }}">
                        <i class="fa-solid fa-chart-bar"></i> Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="{{ route('user.index') }}">
                        <i class="fa-solid fa-users"></i> User
                    </a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $foto = auth()->user()->foto ?? null;
                @endphp

                @if ($foto)
                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Profil" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
                @else
                    <i class="bi bi-person-circle" style="font-size: 1.25rem;"></i>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="adminDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="bi bi-person me-2"></i> Profil Saya
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="#"
                        onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        </div>
    </div>
</nav>
