<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan - Kepala Sekolah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Data Karyawan (Kepala Sekolah)</h1>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th></tr>
            </thead>
            <tbody>
                <?php if (!empty($employees)): ?>
                    <?php foreach ($employees as $i => $e): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= htmlspecialchars($e['nik']) ?></td>
                            <td><?= htmlspecialchars($e['name']) ?></td>
                            <td><?= htmlspecialchars($e['position']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Tidak ada data karyawan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
