<style>
    .gallery-section {
        background: #f5e6c2;
        padding: 40px 0 80px;
        border-radius: 24px;
    }
    .gallery-title {
        font-size: 2.5rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        margin-bottom: 40px;
    }
    .gallery-card {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.08);
    }
    .gallery-card img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        transition: transform 0.45s ease;
    }
    .gallery-card:hover img {
        transform: scale(1.05);
    }
    .gallery-card-body {
        background: rgba(255, 255, 255, 0.92);
        padding: 16px 14px;
        text-align: center;
    }
    .gallery-card-text {
        margin: 0;
        font-size: 0.95rem;
        color: #4d4d4d;
    }
</style>

<?php
$assetGallery = [];
$assetFiles = glob(FCPATH . 'assets/images/*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
if ($assetFiles !== false) {
    foreach ($assetFiles as $filePath) {
        $fileName = basename($filePath);
        if (strtolower($fileName) === 'logo.jpg') {
            continue;
        }
        $assetGallery[] = $fileName;
    }
}
?>

<div class="gallery-section">
    <div class="container">
        <h3 class="text-center gallery-title">Galeri Sekolah</h3>

        <?php if (empty($assetGallery)): ?>
            <div class="alert alert-info">Belum ada foto galeri tersedia.</div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($assetGallery as $fileName): ?>
                    <div class="col">
                        <div class="gallery-card">
                            <img src="<?= base_url('assets/images/'.$fileName) ?>" alt="Foto galeri <?= htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8') ?>">
                            <div class="gallery-card-body">
                                <p class="gallery-card-text">Foto galeri sekolah</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
