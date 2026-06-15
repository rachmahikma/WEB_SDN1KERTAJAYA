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
            <a class="nav-link text-dark me-3" href="<?= site_url('dashboard') ?>">Kembali</a>
            <a class="nav-link text-dark" href="<?= site_url('dashboard/logout') ?>">Keluar</a>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1><?= htmlspecialchars($page_title) ?></h1>
    <p class="text-muted">Kelola data guru, profil, mata pelajaran, dan jadwal mengajar.</p>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= htmlspecialchars($message_type) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <?php if ($view_mode === 'form'): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h4 mb-4"><?= htmlspecialchars($submit_label) ?></h2>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= $form_action ?>">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" value="<?= htmlspecialchars(set_value('nik', isset($form_data['nik']) ? $form_data['nik'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Guru</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars(set_value('name', isset($form_data['name']) ? $form_data['name'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="<?= htmlspecialchars(set_value('subject', isset($form_data['subject']) ? $form_data['subject'] : '')) ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('dashboard/manage_teachers') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submit_label) ?></button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-4">
            <a href="<?= site_url('dashboard/manage_teachers/add') ?>" class="btn btn-primary">Tambah Guru</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($teachers)): ?>
                        <?php foreach ($teachers as $index => $teacher): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($teacher['nik']) ?></td>
                                <td><?= htmlspecialchars($teacher['name']) ?></td>
                                <td><?= htmlspecialchars($teacher['subject']) ?></td>
                                <td>
                                    <a href="<?= site_url('dashboard/manage_teachers/edit/' . $teacher['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('dashboard/manage_teachers/delete/' . $teacher['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data guru ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data guru.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
