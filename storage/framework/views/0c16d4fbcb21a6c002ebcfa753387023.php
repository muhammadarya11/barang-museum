

<?php $__env->startSection('title', 'Edit Koleksi'); ?>

<?php $__env->startSection('konten'); ?>

<style>
    .fullscreen-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: url('<?php echo e(asset('images/museumm.jpeg')); ?>') no-repeat center center fixed;
        background-size: cover;
        z-index: -1;
    }

    .centered-card {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative;
        z-index: 1;
        padding: 20px;
    }

    .form-card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 14px;
        padding: 30px 40px;
        width: 100%;
        max-width: 700px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .form-card img {
        max-width: 100px;
        margin-top: 8px;
    }
</style>

<div class="fullscreen-bg"></div>

<div class="centered-card">
    <div class="form-card">
        <h3 class="text-center mb-4">Edit Koleksi</h3>

        <form action="<?php echo e(route('koleksi.update', $koleksi->id_koleksi)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="nama_koleksi" class="form-label">Nama Koleksi</label>
                <input type="text" name="nama_koleksi" id="nama_koleksi" class="form-control" value="<?php echo e(old('nama_koleksi', $koleksi->nama_koleksi)); ?>" required>
                <?php $__errorArgs = ['nama_koleksi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="asal_koleksi" class="form-label">Asal Koleksi</label>
                <input type="text" name="asal_koleksi" id="asal_koleksi" class="form-control" value="<?php echo e(old('asal_koleksi', $koleksi->asal_koleksi)); ?>">
                <?php $__errorArgs = ['asal_koleksi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="tahun_perolehan" class="form-label">Tahun Perolehan</label>
                <input type="number" name="tahun_perolehan" id="tahun_perolehan" class="form-control" value="<?php echo e(old('tahun_perolehan', $koleksi->tahun_perolehan)); ?>" min="1900" max="2099">
                <?php $__errorArgs = ['tahun_perolehan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi" class="form-control" value="<?php echo e(old('deskripsi', $koleksi->deskripsi)); ?>">
                <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo e(old('kategori', $koleksi->kategori)); ?>">
                <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="id_lokasi" class="form-label">Lokasi</label>
                <select name="id_lokasi" id="id_lokasi" class="form-control">
                    <option value="">-- Pilih Lokasi --</option>
                    <?php $__currentLoopData = $lokasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lokasi->id_lokasi); ?>" <?php echo e(old('id_lokasi', $koleksi->id_lokasi) == $lokasi->id_lokasi ? 'selected' : ''); ?>>
                            <?php echo e($lokasi->nama_lokasi); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['id_lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar Baru</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                <?php if($koleksi->gambar): ?>
                    <p class="mt-2">Gambar saat ini:</p>
                    <img src="<?php echo e(asset('storage/' . $koleksi->gambar)); ?>" alt="Gambar">
                <?php endif; ?>
                <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('koleksi-barang')); ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/edit_koleksi.blade.php ENDPATH**/ ?>