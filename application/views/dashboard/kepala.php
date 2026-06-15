<!DOCTYPE html>
<html>
<head>
    <title>Dasbor Kepala Sekolah</title>
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
            <h1>Dasbor Kepala Sekolah</h1>
            <p class="text-muted">Halo <?= htmlspecialchars($username) ?>, lihat ringkasan data sekolah dan tenaga pendidik.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-info fs-6"><?= htmlspecialchars($role_label) ?></span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/kepala_teachers') ?>">
                <div class="card-body">
                    <h5 class="card-title">Data Guru</h5>
                    <p class="card-text">Lihat daftar guru dan mata pelajaran yang mereka kelola. Total guru: <strong><?= $teachers_count ?? 0 ?></strong>.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/kepala_students') ?>">
                <div class="card-body">
                    <h5 class="card-title">Data Siswa</h5>
                    <p class="card-text">Pantau jumlah siswa, kelas, dan distribusi akademik. Total siswa: <strong><?= $students_count ?? 0 ?></strong>.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/kepala_staff') ?>">
                <div class="card-body">
                    <h5 class="card-title">Data Karyawan</h5>
                    <p class="card-text">Lihat status karyawan administrasi dan staf sekolah. Total karyawan: <strong><?= $employees_count ?? 0 ?></strong>.</p>
                </div>
            </div>
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

        document.querySelectorAll('.toggle-section').forEach(function (button) {
            button.addEventListener('click', function () {
                var target = button.getAttribute('data-target');
                if (!target) return;
                var section = document.querySelector(target);
                if (!section) return;

                var isOpen = section.classList.contains('show');
                document.querySelectorAll('.collapse').forEach(function (div) {
                    if (div !== section) {
                        div.classList.remove('show');
                    }
                });

                if (!isOpen) {
                    section.classList.add('show');
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    });
</script>
</body>
</html>
