<!DOCTYPE html>
<html>
<head>
    <title>SDN 1 Kertajaya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('home') ?>">SDN 1 KERTAJAYA</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="<?= site_url('home') ?>" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="<?= site_url('home/galeri') ?>" class="nav-link">Galeri</a></li>
            <?php if ($this->session->userdata('logged_in')): ?>
                <li class="nav-item"><a href="<?= site_url('dashboard') ?>" class="nav-link">Dasbor</a></li>
                <li class="nav-item"><a href="<?= site_url('dashboard/logout') ?>" class="nav-link">Keluar</a></li>
            <?php else: ?>
                <li class="nav-item"><a href="<?= site_url('login') ?>" class="nav-link">Masuk</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-4">
