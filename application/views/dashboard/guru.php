<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Guru</title>
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
      <h4 class="mb-3">Menu</h4>
      <a href="<?= site_url('dashboard/academic_data') ?>" class="menu-link">Form Nilai Siswa</a>
      <a href="<?= site_url('dashboard/manage_students') ?>" class="menu-link">Kelola Data Siswa</a>
      <a href="<?= site_url('dashboard/manage_students') ?>" class="menu-link">Daftar Kelas</a>
      <a href="<?= site_url('dashboard/academic_data') ?>" class="menu-link">Klasifikasi Prestasi</a>
      <a href="#" class="logout-link text-danger">Keluar</a>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <p class="text-muted">Halo <?= htmlspecialchars($username) ?>, Anda dapat mengelola nilai dan absensi siswa di sini.</p>
        </div>
        <span class="badge bg-success fs-6"><?= htmlspecialchars($role_label) ?></span>
      </div>

      <!-- Summary Boxes -->
      <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="summary-box">Nilai Siswa<br><strong><?= $grades_count ?? 0 ?></strong></div></div>
        <div class="col-md-3"><div class="summary-box">Data Siswa<br><strong><?= $students_count ?? 0 ?></strong></div></div>
        <div class="col-md-3"><div class="summary-box">Kelas<br><strong><?= $classes_count ?? 0 ?></strong></div></div>
      </div>

      <!-- Konten dinamis akan muncul di sini -->
      <div id="mainContent">
        <p class="text-muted">Silakan pilih menu di kiri untuk menampilkan data.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a id="confirmLogout" href="<?= site_url('dashboard/logout') ?>" class="btn btn-danger">Ya</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS wajib -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Fungsi AJAX sederhana untuk load konten
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
    // Logout modal
    document.querySelectorAll('.logout-link').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var modal = new bootstrap.Modal(document.getElementById('logoutModal'));
            modal.show();
        });
    });

    // Menu interactivity
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
