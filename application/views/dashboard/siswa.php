<!DOCTYPE html>
<html>
<head>
    <title>Dasbor Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            <h1>Dasbor Siswa</h1>
            <p class="text-muted">Halo <?= htmlspecialchars($student_name ?? $username) ?>, lihat laporan akademik dan prestasi Anda di sini.</p>
            <?php if (! empty($student_class)): ?>
                <p class="text-muted mb-0">Kelas: <strong><?= htmlspecialchars($student_class) ?></strong></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="<?= site_url('dashboard/siswa_data') ?>" style="text-decoration: none; color: inherit;">
                <div class="card shadow-sm h-100" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Akademik</h5>
                        <p class="card-text">Akses nilai semester, rata-rata, dan catatan pembelajaran Anda. Sudah ada <strong><?= $grades_count ?? 0 ?></strong> entri nilai.</p>
                        <p class="text-muted mb-0 small">Klik untuk lihat detail →</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?= site_url('dashboard/siswa_data') ?>" style="text-decoration: none; color: inherit;">
                <div class="card shadow-sm h-100" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="card-body">
                        <h5 class="card-title">Klasifikasi Prestasi</h5>
                        <p class="card-text">Lihat kategori prestasi sesuai pencapaian akademik dan ekstrakurikuler. Total prestasi: <strong><?= $achievements_count ?? 0 ?></strong>.</p>
                        <p class="text-muted mb-0 small">Klik untuk lihat detail →</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Jadwal Pelajaran</h5>
                    <p class="card-text">Lihat jadwal pelajaran dan kegiatan sekolah Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="<?= site_url('dashboard/siswa_data') ?>" style="text-decoration: none; color: inherit;">
                <div class="card shadow-sm h-100" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="card-body">
                        <h5 class="card-title">Info Akademik</h5>
                        <p class="card-text">Dapatkan informasi penting tentang rapor dan pembinaan prestasi. Catatan hadir: <strong><?= $attendance_count ?? 0 ?></strong>.</p>
                        <p class="text-muted mb-0 small">Klik untuk lihat detail →</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.logout-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
</body>
</html>
