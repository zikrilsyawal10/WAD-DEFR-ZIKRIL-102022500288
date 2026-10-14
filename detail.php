<?php
require 'auth.php';
wajibLogin();
require 'models/Pelanggan.php';

$id = (int)($_GET['id'] ?? 0);
$p = (new Pelanggan())->cari($id);
if (!$p) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px 14px; text-align: left; }
        th { background: #f0f0f0; width: 180px; }
        .badge { padding: 3px 10px; border-radius: 10px; color: #fff; font-size: 0.9em; }
        .Basic { background: #888; }
        .Gold  { background: #c9a227; }
        .VIP   { background: #6a1b9a; }
    </style>
</head>
<body>
    <h2>Profil Pelanggan</h2>
    <table>
        <tr><th>Nama</th><td><?= htmlspecialchars($p['nama']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($p['email']) ?></td></tr>
        <tr><th>No. Telepon</th><td><?= htmlspecialchars($p['no_telepon'] ?? '-') ?></td></tr>
        <tr><th>Alamat</th><td><?= nl2br(htmlspecialchars($p['alamat'] ?? '-')) ?></td></tr>
        <tr>
            <th>Level Member</th>
            <td><span class="badge <?= htmlspecialchars($p['level_member']) ?>"><?= htmlspecialchars($p['level_member']) ?></span></td>
        </tr>
        <tr><th>Tanggal Bergabung</th><td><?= $p['tanggal_bergabung'] ?></td></tr>
    </table>
    <p>
        <a href="ubah.php?id=<?= $p['id'] ?>">Ubah</a> |
        <a href="index.php">Kembali</a>
    </p>
</body>
</html>