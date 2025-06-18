

<?php $__env->startSection('title', 'Tambah Koleksi'); ?>

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
        border-radius: 12px;
        padding: 32px 48px;
        max-width: 700px; /* Lebarkan kanan-kiri */
        width: 100%;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
</style>


<div class="fullscreen-bg"></div>

<div class="centered-card">
    <div class="form-card">
        <h3 class="text-center mb-4">Tambah Koleksi</h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('simpan-koleksi')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="nama_koleksi" class="form-label">Nama Koleksi:</label>
                <input type="text" class="form-control" id="nama_koleksi" name="nama_koleksi" required>
            </div>

            <div class="mb-3">
                <label for="asal_koleksi" class="form-label">Asal Koleksi:</label>
                <input type="text" class="form-control" id="asal_koleksi" name="asal_koleksi">
            </div>

            <div class="mb-3">
                <label for="tahun_perolehan" class="form-label">Tahun Perolehan:</label>
                <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan" min="1900" max="2099" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori:</label>
                <input type="text" class="form-control" id="kategori" name="kategori">
            </div>

            <div class="mb-3">
                <label for="id_lokasi" class="form-label">Lokasi:</label>
                <select name="id_lokasi" id="id_lokasi" class="form-control">
                    <option value="">-- Pilih Lokasi --</option>
                    <?php $__currentLoopData = $lokasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lok->id_lokasi); ?>"><?php echo e($lok->nama_lokasi); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar:</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/admin/tambah_koleksi.blade.php ENDPATH**/ ?>