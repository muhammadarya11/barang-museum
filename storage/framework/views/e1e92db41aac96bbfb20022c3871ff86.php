

<?php $__env->startSection('title', 'Detail Koleksi'); ?>
<?php $__env->startSection('body_class', 'halaman-bergambar'); ?>

<?php $__env->startSection('konten'); ?>
<style>
    .detail-koleksi-card {
        max-width: 900px;
        margin: auto;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .detail-koleksi-card .table th,
    .detail-koleksi-card .table td {
        vertical-align: middle;
        font-size: 15px;
    }

    .detail-koleksi-card .card-header {
        background-color: #F5C518 !important; 
        color: #000 !important;
    }

    @media (max-width: 576px) {
        .detail-koleksi-card .table th,
        .detail-koleksi-card .table td {
            font-size: 14px;
        }

        .detail-koleksi-card img {
            width: 100%;
            height: auto;
        }

        .btn-kembali {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container my-4">
    <div class="card detail-koleksi-card">
        <div class="card-header">
            <h4 class="mb-0">Detail Koleksi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th style="width: 40%;">Nama Koleksi</th>
                        <td><?php echo e($data->nama_koleksi); ?></td>
                    </tr>
                    <tr>
                        <th>Asal Koleksi</th>
                        <td><?php echo e($data->asal_koleksi); ?></td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <td><?php echo e($data->tahun_perolehan); ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><?php echo e($data->deskripsi); ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><?php echo e($data->kategori); ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td><?php echo e($data->lokasi->nama_lokasi ?? 'Tidak ada lokasi'); ?></td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <td>
                            <?php if($data->gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $data->gambar)); ?>" alt="Gambar Koleksi" class="img-fluid rounded" style="max-height: 300px;">
                            <?php else: ?>
                                <em>Tidak ada gambar</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="<?php echo e(route('dashboard.pengunjung')); ?>" class="btn btn-secondary mt-4 btn-kembali">Kembali</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app_pengunjung', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/pengunjung/detail_koleksi.blade.php ENDPATH**/ ?>