@extends('layout.app')

@section('title', 'dashboard')

@section('konten')

<div style="position: relative; height: 320px; overflow: hidden; width: 100vw; margin-left: calc(-50vw + 50%);">
    <img src="{{ asset('images/museum.jpeg') }}" alt="Museum"
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6); display: block;">
    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-3">
        @php
            $rawNama = auth()->user()->nama ?? 'Admin';
            $namaTeks = is_array($rawNama) ? implode(', ', $rawNama) : $rawNama;
        @endphp
        <h2 class="fw-bold">Selamat Datang, {{ $namaTeks }} <span class="fw-normal">(Admin)</span></h2>
        <p class="fst-italic fs-5">Yuk, lihat update terbaru di dashboard ini</p>
    </div>
</div>

<div class="row text-white mt-4">
    @php
        $stats = [
            ['Jumlah Koleksi', $jumlahKoleksi ?? 0, '#8F9E68'],
            ['Jumlah Lokasi', $jumlahLokasi ?? 0, '#9DB17C'],
            ['Jumlah User', $jumlahUser ?? 0, '#B6C89F'],
            ['Laporan Bulanan', $laporanBulanan ?? 0, '#CBDDB5'],
        ];
    @endphp

    @foreach($stats as [$label, $count, $color])
    <div class="col-md-3 mb-3">
        <div class="p-3 text-center shadow-sm" style="background-color: {{ $color }}; border-radius: 10px;">
            <h6>{{ $label }}</h6>
            <h2>{{ $count }}</h2>
        </div>
    </div>
    @endforeach
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="border rounded p-3 shadow-sm d-flex flex-column align-items-center" style="height: 400px;">
            <h5 class="text-center mb-3">Grafik Pie: Koleksi per Kategori</h5>
            <canvas id="pieChart" style="max-height: 300px; max-width: 100%;"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="border rounded p-3 shadow-sm d-flex flex-column align-items-center" style="height: 400px;">
            <h5 class="text-center mb-3">Grafik Bar: Koleksi per Lokasi</h5>
            <canvas id="barChart" style="max-height: 300px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-5 mb-4">
    <div class="card-body">
        <h4 class="text-primary mb-3">Notifikasi</h4>
        <ul class="mb-0 list-unstyled">

            @php
                $notif = session('notifikasi');
                $pesan = is_array($notif) ? ($notif['message'] ?? null) : $notif;
                $ikon = is_array($notif) ? ($notif['icon'] ?? 'info-circle') : 'info-circle';
                $warna = is_array($notif) ? ($notif['color'] ?? 'primary') : 'primary';
            @endphp

            @if($pesan)
            <li class="mb-2">
                <i class="bi bi-{{ $ikon }} me-2 text-{{ $warna }}"></i>
                {{ $pesan }}
            </li>
            @endif
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const kategoriLabels = {!! json_encode($kategoriLabels ?? []) !!};
    const kategoriCounts = {!! json_encode($kategoriCounts ?? []) !!};
    const lokasiLabels = {!! json_encode($lokasiLabels ?? []) !!};
    const lokasiCounts = {!! json_encode($lokasiCounts ?? []) !!};

    if (kategoriLabels.length > 0 && kategoriCounts.length > 0) {
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    data: kategoriCounts,
                    backgroundColor: ['#5C4033', '#8B7355', '#D2B48C', '#F4A460', '#DEB887']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    if (lokasiLabels.length > 0 && lokasiCounts.length > 0) {
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: lokasiLabels,
                datasets: [{
                    label: 'Jumlah Koleksi',
                    data: lokasiCounts,
                    backgroundColor: '#93A384'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    }
</script>

<x-footer />
@endsection