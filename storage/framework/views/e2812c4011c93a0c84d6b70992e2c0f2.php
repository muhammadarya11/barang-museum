

<?php $__env->startSection('title', 'Kelola Koleksi'); ?>

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

    /* Header bar hijau */
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

    /* Form cari */
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
                <a href="<?php echo e(url('/tambah-koleksi')); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah Koleksi
                </a>

                <form action="<?php echo e(route('koleksi-barang')); ?>" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" name="cari" class="search-input" placeholder="Cari Koleksi" value="<?php echo e(request('cari')); ?>">
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
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $formattedId = 'ID' . str_pad($item->id_koleksi, 3, '0', STR_PAD_LEFT);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo e($formattedId); ?></td>
                        <td><?php echo e($item->nama_koleksi); ?></td>
                        <td><?php echo e($item->asal_koleksi); ?></td>
                        <td class="text-center"><?php echo e($item->tahun_perolehan); ?></td>
                        <td><?php echo e($item->deskripsi); ?></td>
                        <td><?php echo e($item->kategori); ?></td>
                        <td><?php echo e($item->lokasi ? $item->lokasi->nama_lokasi : '-'); ?></td>
                        <td class="text-center">
                            <?php if($item->gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" alt="Gambar" style="width: 50px; height: auto;">
                            <?php else: ?>
                                <em class="text-muted">Tidak ada gambar</em>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="<?php echo e(route('koleksi.edit', $item->id_koleksi)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('koleksi.hapus', $item->id_koleksi)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/koleksi.blade.php ENDPATH**/ ?>