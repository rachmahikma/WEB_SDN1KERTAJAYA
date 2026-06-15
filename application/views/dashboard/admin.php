<!DOCTYPE html>
<html>
<head>
    <title>Dasbor Admin / Tata Usaha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>">Dasbor</a>
        <div class="d-flex align-items-center">
            <a href="<?= site_url('dashboard') ?>" class="nav-link text-dark me-3">Dasbor</a>
            <a id="logout-link" href="<?= site_url('dashboard/logout') ?>" class="nav-link text-dark">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Dasbor Admin / Tata Usaha</h1>
            <p class="text-muted">Halo <?= htmlspecialchars($username) ?>, kelola data sekolah Anda dari sini.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-primary fs-6"><?= htmlspecialchars($role_label) ?></span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_students') ?>">
                <div class="card-body">
                    <h5 class="card-title">Kelola Data Siswa</h5>
                    <p class="card-text">Terdapat <strong><?= $students_count ?? 0 ?></strong> siswa terdaftar. Tambah, edit, atau hapus informasi siswa termasuk kelas dan status akademik.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_teachers') ?>">
                <div class="card-body">
                    <h5 class="card-title">Kelola Data Guru</h5>
                    <p class="card-text">Terdapat <strong><?= $teachers_count ?? 0 ?></strong> guru terdaftar. Atur profil guru, mata pelajaran, dan jadwal mengajar.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_staff') ?>">
                <div class="card-body">
                    <h5 class="card-title">Kelola Data Karyawan</h5>
                    <p class="card-text">Terdapat <strong><?= $employees_count ?? 0 ?></strong> karyawan terdaftar. Pantau karyawan sekolah serta tanggung jawab mereka.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/manage_users') ?>">
                <div class="card-body">
                    <h5 class="card-title">Kelola Pengguna</h5>
                    <p class="card-text">Terdapat <strong><?= $users_count ?? 0 ?></strong> akun pengguna. Buat dan kelola akun pengguna dengan hak akses yang sesuai.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 clickable-card" data-link="<?= site_url('dashboard/academic_data') ?>">
                <div class="card-body">
                    <h5 class="card-title">Data Akademik</h5>
                    <p class="card-text">Data akademik berisi <strong><?= $grades_count ?? 0 ?></strong> nilai dan <strong><?= $attendance_count ?? 0 ?></strong> catatan kehadiran.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var logoutLink = document.getElementById('logout-link');
        if (logoutLink) {
            logoutLink.addEventListener('click', function (event) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    event.preventDefault();
                }
            });
        }

        document.querySelectorAll('.clickable-card').forEach(function (card) {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function () {
                var link = card.getAttribute('data-link');
                if (link) {
                    window.location.href = link;
                }
            });
        });
    });
</script>
</body>
</html>
