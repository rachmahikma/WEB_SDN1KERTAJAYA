<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>">Dasbor</a>
        <div class="d-flex align-items-center">
            <a href="<?= site_url('dashboard') ?>" class="nav-link text-dark me-3">Kembali</a>
            <a class="logout-link nav-link text-dark" href="<?= site_url('dashboard/logout') ?>">Keluar</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1><?= htmlspecialchars($page_title) ?></h1>
    <p class="text-muted">Informasi lengkap data siswa, nilai, absensi, dan prestasi Anda dari data guru kelas.</p>

    <!-- Identitas Siswa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Data Pribadi Siswa</h5>
                    <table class="table table-sm mb-0">
                        <tr>
                            <td class="fw-bold" style="width: 40%;">NISN</td>
                            <td><?= htmlspecialchars($student['nisn'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Nama</td>
                            <td><?= htmlspecialchars($student['name'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Kelas</td>
                            <td><?= htmlspecialchars($student['class'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Status</td>
                            <td><?= htmlspecialchars($student['status'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Akademik dari Data Guru Kelas -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">📊 Nilai Akademik dari Guru Kelas <?= htmlspecialchars($student['class'] ?? '-') ?></h5>
            <small class="text-muted">Data diambil dari laporan guru pengajar kelas Anda</small>
        </div>
        <div class="card-body">
            <?php if (!empty($student_grades)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Akademik</th>
                                <th>Absensi</th>
                                <th>Sikap</th>
                                <th>Ekstrakurikuler</th>
                                <th>Nilai Akhir</th>
                                <th>Kategori</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($student_grades as $index => $grade): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($grade['subject'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($grade['score'] ?? 0) ?></td>
                                    <td><?= htmlspecialchars($grade['attendance_score'] ?? 0) ?></td>
                                    <td><?= htmlspecialchars($grade['attitude_score'] ?? 0) ?></td>
                                    <td><?= htmlspecialchars($grade['extracurricular_score'] ?? 0) ?></td>
                                    <td><strong><?= htmlspecialchars($grade['final_score'] ?? 0) ?></strong></td>
                                    <td>
                                        <span class="badge bg-<?= $grade['classification'] === 'Tinggi' ? 'success' : ($grade['classification'] === 'Sedang' ? 'warning' : 'danger') ?>">
                                            <?= htmlspecialchars($grade['classification'] ?? 'Rendah') ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($grade['semester'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info mt-3">
                    <strong>ℹ️ Informasi:</strong> Nilai-nilai ini berasal dari data guru kelas <?= htmlspecialchars($student['class'] ?? '-') ?> dan telah disesuaikan dengan pencapaian Anda.
                </div>
            <?php else: ?>
                <p class="text-muted">Tidak ada data nilai dari guru kelas untuk ditampilkan saat ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Absensi -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">📝 Catatan Kehadiran</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($student_attendance)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($student_attendance as $index => $att): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($att['date'] ?? '-') ?></td>
                                    <td>
                                        <?php 
                                            $statusColor = 'secondary';
                                            if ($att['status'] === 'Hadir') {
                                                $statusColor = 'success';
                                            } elseif ($att['status'] === 'Izin') {
                                                $statusColor = 'warning';
                                            } elseif ($att['status'] === 'Sakit') {
                                                $statusColor = 'info';
                                            } elseif ($att['status'] === 'Alpha') {
                                                $statusColor = 'danger';
                                            }
                                        ?>
                                        <span class="badge bg-<?= $statusColor ?>"><?= htmlspecialchars($att['status'] ?? '-') ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">Tidak ada data absensi.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Prestasi -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">🏆 Prestasi dan Penghargaan</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($student_achievements)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul Prestasi</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($student_achievements as $index => $achievement): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($achievement['title'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($achievement['category'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($achievement['date'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($achievement['description'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">Tidak ada data prestasi.</p>
            <?php endif; ?>
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
