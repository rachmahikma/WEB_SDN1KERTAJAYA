<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa - Kepala Sekolah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Data Siswa (Kepala Sekolah)</h1>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr><th>No</th><th>NISN</th><th>Nama</th><th>Kelas</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $i => $s): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($s['nisn']) ?></td>
                            <td><?= htmlspecialchars($s['name']) ?></td>
                            <td><?= htmlspecialchars($s['class']) ?></td>
                            <td><?= htmlspecialchars($s['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">Tidak ada data siswa.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
