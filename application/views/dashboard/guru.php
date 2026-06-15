<!DOCTYPE html>
<html>
<head>
    <title>Dasbor Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .clickable-card{cursor:pointer}
        .clickable-card:focus{outline:2px solid #0d6efd;outline-offset:2px}
        .clickable-card:hover{transform:translateY(-4px);transition:transform .12s ease}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>">Dasbor</a>
        <div class="d-flex align-items-center">
            <a href="<?= site_url('dashboard') ?>" class="nav-link text-dark me-3">Dasbor</a>
            <a class="logout-link nav-link text-dark" href="<?= site_url('dashboard/logout') ?>">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Dasbor Guru</h1>
            <p class="text-muted">Halo <?= htmlspecialchars($username) ?>, Anda dapat mengelola nilai dan absensi siswa di sini.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-success fs-6"><?= htmlspecialchars($role_label) ?></span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/academic_data') ?>">
                <div class="card-body">
                    <h5 class="card-title">Form Nilai Siswa</h5>
                    <p class="card-text">Masukkan nilai akademik, sikap, ekstrakurikuler, dan kehadiran untuk setiap siswa. Sudah ada <strong><?= $grades_count ?? 0 ?></strong> entri nilai.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_students') ?>">
                <div class="card-body">
                    <h5 class="card-title">Kelola Data Siswa</h5>
                    <p class="card-text">Lihat dan perbarui daftar siswa serta kelas yang Anda ampu. Total siswa saat ini <strong><?= $students_count ?? 0 ?></strong>.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/academic_data') ?>">
                <div class="card-body">
                    <h5 class="card-title">Klasifikasi Prestasi</h5>
                    <p class="card-text">Lihat kategori prestasi siswa (Tinggi, Sedang, Rendah) berdasarkan penilaian lengkap.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_students') ?>">
                <div class="card-body">
                    <h5 class="card-title">Daftar Kelas</h5>
                    <p class="card-text">Lihat daftar kelas dan daftar siswa yang Anda ampu. Total kelas saat ini <strong><?= $classes_count ?? 0 ?></strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Confirm on logout
        document.querySelectorAll('.logout-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    event.preventDefault();
                }
            });
        });

        // Make dashboard cards clickable and keyboard-accessible
        document.querySelectorAll('.clickable-card').forEach(function (card) {
            var link = card.getAttribute('data-link');
            if (!link) return;
            // make it focusable for keyboard users
            card.setAttribute('tabindex', '0');
            card.setAttribute('role', 'button');
            card.addEventListener('click', function () {
                window.location.href = link;
            });
            card.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    window.location.href = link;
                }
            });
        });
    });
</script>
</body>
</html>
