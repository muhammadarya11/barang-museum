<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - DigiMuseum</title>

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?>

    <style>
        body.halaman-bergambar {
            background: url("<?php echo e(asset('images/museumm.jpeg')); ?>") no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .koleksi-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .koleksi-wrapper main {
            flex: 1;
            padding-top: 20px;
        }

        .navbar-custom {
            background: linear-gradient(to right, #2c2b2b, #d3ac7f);
            padding: 14px 0;
        }

        .navbar-brand i {
            font-size: 28px;
        }

        .nav-link {
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            font-size: 1rem;
        }

        footer {
            background: linear-gradient(to right, #2c2b2b, #d3ac7f);
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer i {
            font-size: 20px;
            margin: 0 10px;
        }

        @media (max-width: 768px) {
            .nav-link {
                justify-content: center;
                padding: 10px 0;
            }
        }
    </style>
</head>
<body class="<?php echo $__env->yieldContent('body_class'); ?>">

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm sticky-top">
    <div class="container">
        
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="<?php echo e(route('dashboard.pengunjung')); ?>">
            <i class="fa-solid fa-landmark me-2"></i>
            Museum Sejarah Nasional
        </a>

        
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fs-4"></i>
        </button>

        
        <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="<?php echo e(route('dashboard.pengunjung')); ?>">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="<?php echo e(route('koleksi.pengunjung')); ?>">
                        <i class="bi bi-collection"></i> Koleksi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-1" href="<?php echo e(route('tentang.museum')); ?>">
                        <i class="bi bi-info-circle"></i> Tentang Museum
                    </a>
                </li>

                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                            $foto = auth()->user()->foto ?? null;
                        ?>

                        <?php if($foto): ?>
                            <img src="<?php echo e(asset('storage/' . $foto)); ?>" alt="Foto Profil" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
                        <?php else: ?>
                            <i class="bi bi-person-circle" style="font-size: 1.25rem;"></i>
                        <?php endif; ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                                <i class="bi bi-person me-2"></i> Profil Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="koleksi-wrapper">
    <main>
        <?php echo $__env->yieldContent('konten'); ?>
    </main>
</div>

<?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->yieldPushContent('modals'); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\barang-museum2\barang-museum\resources\views/layout/app_pengunjung.blade.php ENDPATH**/ ?>