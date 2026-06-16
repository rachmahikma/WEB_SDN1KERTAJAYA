<!DOCTYPE html>
<html>
<head>
  <title>Dasbor Siswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .sidebar {
      min-height: 100vh;
      background-color: #ffc107;
      padding: 1rem;
    }
    .sidebar a {
      display: block;
      padding: .5rem 1rem;
      color: #212529;
      text-decoration: none;
      margin-bottom: .25rem;
      border-radius: .25rem;
    }
    .sidebar a:hover {
      background-color: #fff3cd;
    }
    .summary-box {
      background: #fff;
      border-radius: .5rem;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <h4 class="mb-3">Menu Siswa</h4>
      <a href="<?= site_url('dashboard/siswa') ?>" class="menu-link">Dasbor</a>
      <a href="<?= site_url('dashboard/siswa_data') ?>" class="menu-link">Laporan Akademik</a>
      <a href="<?= site_url('dashboard/siswa_data') ?>" class="menu-link">Klasifikasi Prestasi</a>
      <a href="<?= site_url('dashboard/siswa_data') ?>" class="menu-link">Info Akademik</a>
      <a href="<?= site_url('dashboard/logout') ?>" class="logout-link text-danger">Keluar</a>
			<a href="<?= site_url('dashboard/siswa_export_pdf') ?>" class="btn btn-sm btn-danger">
    Download PDF
</a>

    </div>

    <!-- Main Content -->
    <div class="col-md-9 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2>Dasbor Siswa</h2>
          <p class="text-muted">Halo <?= htmlspecialchars($student_name ?? $username) ?>, lihat laporan akademik dan prestasi Anda di sini.</p>
          <?php if (! empty($student_class)): ?>
            <p class="text-muted mb-0">Kelas: <strong><?= htmlspecialchars($student_class) ?></strong></p>
          <?php endif; ?>
        </div>
        <span class="badge bg-success fs-6">Siswa</span>
      </div>

      <!-- Summary Boxes -->
      <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="summary-box">Nilai<br><strong><?= $grades_count ?? 0 ?></strong></div></div>
        <div class="col-md-3"><div class="summary-box">Prestasi<br><strong><?= $achievements_count ?? 0 ?></strong></div></div>
        <div class="col-md-3"><div class="summary-box">Absensi<br><strong><?= $attendance_count ?? 0 ?></strong></div></div>
      </div>

      <!-- Konten dinamis -->
      <div id="mainContent">
        <p class="text-muted">Silakan pilih menu di kiri untuk menampilkan data.</p>
      </div>
    </div>
  </div>
</div>

<script>
function loadContent(url) {
  fetch(url)
    .then(response => response.text())
    .then(html => {
      document.getElementById('mainContent').innerHTML = html;
    })
    .catch(err => {
      document.getElementById('mainContent').innerHTML = "<p class='text-danger'>Gagal memuat konten.</p>";
    });
}

document.addEventListener('DOMContentLoaded', function () {
  // Logout konfirmasi
  document.querySelectorAll('.logout-link').forEach(function (link) {
    link.addEventListener('click', function (event) {
      if (!confirm('Apakah Anda yakin ingin logout?')) {
        event.preventDefault();
      }
    });
  });

  // Menu interaktif
  document.querySelectorAll('.menu-link').forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault();
      var url = this.getAttribute('href');
      loadContent(url);
    });
  });
});
</script>
</body>
</html>
