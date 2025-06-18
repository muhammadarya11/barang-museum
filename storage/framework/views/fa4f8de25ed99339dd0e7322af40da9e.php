

<?php $__env->startSection('title', 'User'); ?>

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
                <a href="<?php echo e(url('user/tambah')); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle me-1"></i> Tambah User
                </a>

                <form action="<?php echo e(route('user.index')); ?>" method="GET" class="search-box">
                    <i class="fa fa-search search-icon"></i>
                    <input type="search" name="cari" class="search-input" placeholder="Cari User" value="<?php echo e(request('cari')); ?>">
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
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center"><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->nama); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td class="text-center"><?php echo e($user->role); ?></td>
                        <td class="text-center">
                            <em>********</em>
                            <a href="<?php echo e(route('user.reset_password', $user->id)); ?>" class="btn btn-sm btn-warning ms-2 btn-icon-sm" title="Reset Password">
                                <i class="fa fa-key"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-sm btn-outline-primary btn-icon-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                        <form action="<?php echo e(route('user.hapus', $user->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin hapus user ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-icon-sm" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/user.blade.php ENDPATH**/ ?>