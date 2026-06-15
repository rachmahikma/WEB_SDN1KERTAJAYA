<!DOCTYPE html>
<html>
<head>
    <title>SDN 1 Kertajaya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex flex-column min-vh-100">

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

<div class="container mt-4 flex-grow-1">
    <style>
        .home-hero {
            background: linear-gradient(180deg, #fff8e1 0%, #ffffff 100%);
            padding: 40px 0 20px;
            border-radius: 0 0 32px 32px;
            margin-bottom: 30px;
        }

        .home-hero h1 {
            font-size: 2.0rem;
            letter-spacing: .03em;
        }

        .home-hero .lead {
            font-size: 1.5rem;
            color: #121517;
        }

        .school-logo {
            width: 220px;
            height: 220px;
            background: #ffffff;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
        }

        .school-logo-inner {
            text-align: center;
            font-weight: 700;
            color: #495057;
            font-size: 1rem;
        }
        .contact-section {
            background: #f8f9fa;
            padding: 40px 0;
            margin-top: 40px;
        }
        .contact-section h4 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .contact-section .list-unstyled li {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .contact-section .ratio {
            max-height: 300px;
        }
    </style>

    <div class="home-hero text-center">
        <div class="container">
            <h1 class="fw-bold">SELAMAT DATANG DI SISTEM INFORMASI SEKOLAH</h1>
            <h1 class="fw-bold">SDN 1 KERTAJAYA</h1>
            <p class="lead mt-3">Terwujudnya peserta didik yang beragama, cerdas, cakap, kreatif, dan mandiri.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center py-5">
                    <h2 class="mb-4">Profil Sekolah</h2>
                    <div class="school-logo">
                        <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="Logo SDN 1 Kertajaya" class="img-fluid" style="max-width: 250px; max-height: 250px;" />
                    </div>
                    <p class="mb-0 text-muted">SDN 1 Kertajaya adalah sebuah sekolah dasar yang berkomitmen membentuk siswa berkarakter, berprestasi, dan siap menghadapi tantangan masa depan.
                        Juga sekolah dasar yang berkomitmen pada pendidikan karakter dan akademik. Sekolah ini menyediakan lingkungan belajar yang aman, ramah, dan mendukung perkembangan siswa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Visi</h5>
                    <p class="card-text">Terwujudnya peserta didik yang beragama, cerdas, cakap, kreatif, dan mandiri.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Misi</h5>
                    <ul class="mb-0">
                        <li>Mengembangkan nilai luhur</li>
                        <li>Pendidikan berbasis teknologi</li>
                        <li>Meningkatkan ilmu pengetahuan</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tujuan</h5>
                    <p class="card-text">Membentuk siswa berakhlak dan berprestasi melalui pendidikan yang bermutu.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Kontak Kami</h4>
                    <p>Silakan hubungi kami di alamat berikut:</p>
                    <ul class="list-unstyled">
                        <li><strong>Alamat:</strong> Jl. U.Suryadi No.12, Kertajaya, Kec. Padalarang, Kabupaten Bandung Barat, Jawa Barat 40553</li>
                        <li><strong>Telepon:</strong> +62226806911</li>
                        <li><strong>Email:</strong> info@sdn1kertajaya.sch.id</li>
                    </ul>
                    <p>Jam operasional:</p>
                    <ul>
                        <li>Senin - Jumat: 07.00 - 15.00</li>
                        <li>Sabtu: 07.00 - 12.00</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0428467262587!2d107.4924468!3d-6.8495093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1sSD%20Negeri%201%20Kertajaya!2s-6.8495093,107.4924468!5e0!3m2!1sid!2sid!4v1234567890123" 
                            allowfullscreen
                            loading="lazy"
                            style="border:0;">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center mt-auto p-3 bg-light border-top">
    <div class="mb-3">
        <a href="<?= site_url('home/galeri') ?>" class="btn btn-outline-primary me-2">Galeri</a>
        <a href="<?= site_url('login') ?>" class="btn btn-outline-secondary">Masuk</a>
    </div>
    <p class="mb-0">© 2026 SDN 1 Kertajaya</p>
</footer>

</div>
</body>
</html>
