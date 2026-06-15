<!DOCTYPE html>
<html>
<head>
    <title>Data Guru - Kepala Sekolah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Data Guru (Kepala Sekolah)</h1>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr><th>No</th><th>NIK</th><th>Nama</th><th>Mata Pelajaran</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($teachers)): ?>
                    <?php foreach ($teachers as $i => $t): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($t['nik']) ?></td>
                            <td><?= htmlspecialchars($t['name']) ?></td>
                            <td><?= htmlspecialchars($t['subject']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Tidak ada data guru.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
