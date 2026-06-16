<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Data Siswa</h2>
    <table>
        <tr><th>NISN</th><td><?= $student['nisn'] ?></td></tr>
        <tr><th>Nama</th><td><?= $student['name'] ?></td></tr>
        <tr><th>Kelas</th><td><?= $student['class'] ?></td></tr>
        <tr><th>Status</th><td><?= $student['status'] ?></td></tr>
    </table>
</body>
</html>
