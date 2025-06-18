

<?php $__env->startSection('title', 'Laporan Statistik'); ?>

<?php $__env->startSection('konten'); ?>


<div class="fullscreen-bg"></div>

<style>
    .fullscreen-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: url('<?php echo e(asset('images/museumm.jpeg')); ?>') no-repeat center center;
        background-size: cover;
        z-index: -1;
    }

    .header-laporan {
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

        <div class="header-laporan">
            <h4 class="text-white m-0">Laporan Statistik</h4>

            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo e(url('/tambah-laporan')); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah Laporan
                </a>

                <form action="<?php echo e(route('laporan-statistik')); ?>" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="search" name="cari" class="search-input" placeholder="Cari Laporan" value="<?php echo e(request('cari')); ?>">
                </form>
            </div>
        </div>

        <table class="table table-bordered bg-white rounded">
            <thead>
                <tr>
                    <th style="width: 8%;">ID Laporan</th>
                    <th style="width: 30%;">Judul</th>
                    <th style="width: 25%;">Tanggal</th>
                    <th style="width: 25%;">Deskripsi</th>
                    <th style="width: 12%;">File</th>
                    <th style="width: 12%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $idFormatted = 'LP' . str_pad($item->id_laporan, 3, '0', STR_PAD_LEFT);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo e($idFormatted); ?></td>
                        <td><?php echo e($item->judul_laporan); ?></td>
                        <td class="text-center"><?php echo e(\Carbon\Carbon::parse($item->tanggal_laporan)->format('d M Y')); ?></td>
                        <td><?php echo e(\Illuminate\Support\Str::limit($item->deskripsi, 50)); ?></td>
                        <td class="text-center">
                            <?php if($item->file_laporan): ?>
                                <a href="<?php echo e(asset('uploads/laporan/' . $item->file_laporan)); ?>" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-success" 
                                   title="Download">
                                    <i class="fa fa-download"></i>
                                </a>
                            <?php else: ?>
                                <em class="text-muted">Tidak ada file</em>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="<?php echo e(route('laporan.edit', $item->id_laporan)); ?>" 
                                   class="btn btn-sm btn-outline-primary" 
                                   title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="<?php echo e(url('/hapus-laporan/' . $item->id_laporan)); ?>" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin hapus laporan?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            type="submit" 
                                            title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data laporan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/laporan.blade.php ENDPATH**/ ?>