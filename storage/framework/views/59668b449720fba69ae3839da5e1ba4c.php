

<?php $__env->startSection('title', 'dashboard'); ?>

<?php $__env->startSection('konten'); ?>

<div style="position: relative; height: 320px; overflow: hidden; width: 100vw; margin-left: calc(-50vw + 50%);">
    <img src="<?php echo e(asset('images/museum.jpeg')); ?>" alt="Museum"
         style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6); display: block;">
    <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-3">
        <?php
            $rawNama = auth()->user()->nama ?? 'Admin';
            $namaTeks = is_array($rawNama) ? implode(', ', $rawNama) : $rawNama;
        ?>
        <h2 class="fw-bold">Selamat Datang, <?php echo e($namaTeks); ?> <span class="fw-normal">(Admin)</span></h2>
        <p class="fst-italic fs-5">Yuk, lihat update terbaru di dashboard ini</p>
    </div>
</div>

<div class="row text-white mt-4">
    <?php
        $stats = [
            ['Jumlah Koleksi', $jumlahKoleksi ?? 0, '#8F9E68'],
            ['Jumlah Lokasi', $jumlahLokasi ?? 0, '#9DB17C'],
            ['Jumlah User', $jumlahUser ?? 0, '#B6C89F'],
            ['Laporan Bulanan', $laporanBulanan ?? 0, '#CBDDB5'],
        ];
    ?>

    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $count, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3 mb-3">
        <div class="p-3 text-center shadow-sm" style="background-color: <?php echo e($color); ?>; border-radius: 10px;">
            <h6><?php echo e($label); ?></h6>
            <h2><?php echo e($count); ?></h2>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            <?php
                $notif = session('notifikasi');
                $pesan = is_array($notif) ? ($notif['message'] ?? null) : $notif;
                $ikon = is_array($notif) ? ($notif['icon'] ?? 'info-circle') : 'info-circle';
                $warna = is_array($notif) ? ($notif['color'] ?? 'primary') : 'primary';
            ?>

            <?php if($pesan): ?>
            <li class="mb-2">
                <i class="bi bi-<?php echo e($ikon); ?> me-2 text-<?php echo e($warna); ?>"></i>
                <?php echo e($pesan); ?>

            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const kategoriLabels = <?php echo json_encode($kategoriLabels ?? []); ?>;
    const kategoriCounts = <?php echo json_encode($kategoriCounts ?? []); ?>;
    const lokasiLabels = <?php echo json_encode($lokasiLabels ?? []); ?>;
    const lokasiCounts = <?php echo json_encode($lokasiCounts ?? []); ?>;

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

<?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/home.blade.php ENDPATH**/ ?>