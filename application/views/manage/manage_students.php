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
    <p class="text-muted">Kelola data siswa, tambahkan data baru, sunting, dan hapus siswa sesuai kebutuhan.</p>

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
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="form-control" value="<?= htmlspecialchars(set_value('nisn', isset($form_data['nisn']) ? $form_data['nisn'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Siswa</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars(set_value('name', isset($form_data['name']) ? $form_data['name'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-select" required>
                            <?php $class_value = set_value('class', isset($form_data['class']) ? $form_data['class'] : ''); ?>
                            <?php foreach ($class_options as $classKey => $classLabel): ?>
                                <option value="<?= htmlspecialchars($classKey) ?>" <?= $class_value === $classKey ? 'selected' : '' ?>><?= htmlspecialchars($classLabel) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <?php $status_value = set_value('status', isset($form_data['status']) ? $form_data['status'] : 'Aktif'); ?>
                            <option value="Aktif" <?= $status_value === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Cuti" <?= $status_value === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
                            <option value="Keluar" <?= $status_value === 'Keluar' ? 'selected' : '' ?>>Keluar</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('dashboard/manage_students') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submit_label) ?></button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-4 d-flex flex-wrap gap-2">
            <a href="<?= site_url('dashboard/manage_students/add') ?>" class="btn btn-primary">Tambah Siswa</a>
            <a href="<?= site_url('dashboard/manage_students/generate_usernames') ?>" class="btn btn-success">Buat Username dan Akun Siswa</a>
        </div>
        <?php $classOrder = ['1', '2', '3', '4', '5', '6']; ?>
        <?php if (!empty($students_by_class)): ?>
            <?php foreach ($classOrder as $classKey): ?>
                <?php if (!empty($students_by_class[$classKey])): ?>
                    <div class="mb-4">
                        <h3>Kelas <?= htmlspecialchars($classKey) ?></h3>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students_by_class[$classKey] as $index => $student): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($student['nisn']) ?></td>
                                            <td><?= htmlspecialchars($student['name']) ?></td>
                                            <td><?= htmlspecialchars($student['username'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($student['status']) ?></td>
                                            <td>
                                                <a href="<?= site_url('dashboard/manage_students/edit/' . $student['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= site_url('dashboard/manage_students/delete/' . $student['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data siswa ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!empty($students_by_class['Lainnya'])): ?>
                <div class="mb-4">
                    <h3>Lainnya</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Username</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students_by_class['Lainnya'] as $index => $student): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($student['nisn']) ?></td>
                                        <td><?= htmlspecialchars($student['name']) ?></td>
                                        <td><?= htmlspecialchars($student['username'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($student['class']) ?></td>
                                        <td><?= htmlspecialchars($student['status']) ?></td>
                                        <td>
                                            <a href="<?= site_url('dashboard/manage_students/edit/' . $student['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= site_url('dashboard/manage_students/delete/' . $student['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data siswa ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-secondary">Tidak ada data siswa.</div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
