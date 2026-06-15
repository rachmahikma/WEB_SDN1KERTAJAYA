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
    <p class="text-muted">Kelola akun pengguna dan hak akses untuk admin, guru, kepala sekolah, dan siswa.</p>

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
                        <label for="username" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars(set_value('username', isset($form_data['username']) ? $form_data['username'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars(set_value('name', isset($form_data['name']) ? $form_data['name'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Peran</label>
                        <?php $role_value = set_value('role', isset($form_data['role']) ? $form_data['role'] : 'admin'); ?>
                        <select name="role" id="role" class="form-select" required>
                            <?php foreach ($roles as $role_key => $role_label): ?>
                                <option value="<?= htmlspecialchars($role_key) ?>" <?= $role_key === $role_value ? 'selected' : '' ?>><?= htmlspecialchars($role_label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" name="password" id="password" class="form-control" <?= $view_mode === 'form' && isset($form_data) && !empty($form_data) ? '' : 'required' ?>>
                        <?php if ($view_mode === 'form' && isset($form_data) && !empty($form_data)): ?>
                            <div class="form-text">Kosongkan jika tidak ingin mengubah kata sandi.</div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('dashboard/manage_users') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submit_label) ?></button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-4">
            <a href="<?= site_url('dashboard/manage_users/add') ?>" class="btn btn-primary">Tambah Pengguna</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Nama Lengkap</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                                <td>
                                    <a href="<?= site_url('dashboard/manage_users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('dashboard/manage_users/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengguna ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
