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
    <p class="text-muted">Kelola data akademik, tambah nilai, dan edit informasi prestasi siswa.</p>

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
                        <label for="student_id" class="form-label">Nama Siswa</label>
                        <select name="student_id" id="student_id" class="form-select" required>
                            <option value="">Pilih siswa</option>
                            <?php $student_id_value = set_value('student_id', isset($form_data['student_id']) ? $form_data['student_id'] : ''); ?>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= htmlspecialchars($student['id']) ?>" <?= $student['id'] == $student_id_value ? 'selected' : '' ?>><?= htmlspecialchars($student['name']) ?> (<?= htmlspecialchars($student['nisn']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="<?= htmlspecialchars(set_value('subject', isset($form_data['subject']) ? $form_data['subject'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="score" class="form-label">Nilai</label>
                        <input type="number" name="score" id="score" class="form-control" min="0" max="100" value="<?= htmlspecialchars(set_value('score', isset($form_data['score']) ? $form_data['score'] : '')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="attendance_score" class="form-label">Skor Absensi (0-100)</label>
                        <input type="number" name="attendance_score" id="attendance_score" class="form-control" min="0" max="100" value="<?= htmlspecialchars(set_value('attendance_score', isset($form_data['attendance_score']) ? $form_data['attendance_score'] : '')) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="attitude_score" class="form-label">Skor Sikap (0-100)</label>
                        <input type="number" name="attitude_score" id="attitude_score" class="form-control" min="0" max="100" value="<?= htmlspecialchars(set_value('attitude_score', isset($form_data['attitude_score']) ? $form_data['attitude_score'] : '')) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="extracurricular_score" class="form-label">Skor Ekstrakurikuler (0-100)</label>
                        <input type="number" name="extracurricular_score" id="extracurricular_score" class="form-control" min="0" max="100" value="<?= htmlspecialchars(set_value('extracurricular_score', isset($form_data['extracurricular_score']) ? $form_data['extracurricular_score'] : '')) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" name="semester" id="semester" class="form-control" value="<?= htmlspecialchars(set_value('semester', isset($form_data['semester']) ? $form_data['semester'] : '')) ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('dashboard/academic_data') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submit_label) ?></button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="mb-4">
            <a href="<?= site_url('dashboard/academic_data/add') ?>" class="btn btn-primary">Tambah Nilai</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai (Akademik)</th>
                        <th>Absensi</th>
                        <th>Sikap</th>
                        <th>Ekstrakulikuler</th>
                        <th>Nilai Akhir</th>
                        <th>Kategori Prestasi</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($grades)): ?>
                        <?php foreach ($grades as $index => $grade): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($grade['student_name']) ?></td>
                                <td><?= htmlspecialchars($grade['subject']) ?></td>
                                <td><?= htmlspecialchars($grade['score']) ?></td>
                                <td><?= htmlspecialchars($grade['attendance_score'] ?? 0) ?></td>
                                <td><?= htmlspecialchars($grade['attitude_score'] ?? 0) ?></td>
                                <td><?= htmlspecialchars($grade['extracurricular_score'] ?? 0) ?></td>
                                <td><?= htmlspecialchars($grade['final_score'] ?? 0) ?></td>
                                <td><?= htmlspecialchars($grade['classification'] ?? 'Rendah') ?></td>
                                <td><?= htmlspecialchars($grade['semester']) ?></td>
                                <td>
                                    <a href="<?= site_url('dashboard/academic_data/edit/' . $grade['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('dashboard/academic_data/delete/' . $grade['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus catatan akademik ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted">Tidak ada data akademik.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
