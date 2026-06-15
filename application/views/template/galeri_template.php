<!DOCTYPE html>
<html>
<head>
    <title>SDN 1 Kertajaya - Galeri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('home') ?>">SDN 1 KERTAJAYA</a>
        <div class="d-flex align-items-center">
            <a href="<?= site_url('home') ?>" class="nav-link text-dark me-3">Beranda</a>
            <a href="<?= site_url('home/galeri') ?>" class="nav-link text-dark me-3">Galeri</a>
            <?php if ($this->session->userdata('logged_in')): ?>
                <a href="<?= site_url('dashboard') ?>" class="nav-link text-dark me-3">Dasbor</a>
                <a href="<?= site_url('dashboard/logout') ?>" class="nav-link text-dark">Keluar</a>
            <?php else: ?>
                <a href="<?= site_url('login') ?>" class="nav-link text-dark">Masuk</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php $this->load->view('galeri'); ?>
</div>

<footer class="text-center mt-5 p-3 bg-light">
    <div class="mb-2">
        <a href="<?= site_url('home') ?>" class="text-decoration-none">← Kembali ke Beranda</a>
    </div>
    <p>© 2026 SDN 1 Kertajaya</p>
</footer>

</body>
</html>
