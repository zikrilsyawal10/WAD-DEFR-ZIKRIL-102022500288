<?php
require 'auth.php';
wajibLogin();
require 'models/Pelanggan.php';
$model = new Pelanggan();
$daftar = $model->semua();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #f0f0f0; }
        form { display: inline; }
        .hapus { background: none; border: none; color: #c00; cursor: pointer; font-size: 1em; padding: 0; text-decoration: underline; }
    </style>
</head>
<body>
    <h2>Data Pelanggan & Member</h2>
        <p>Login sebagai <b><?= htmlspecialchars($_SESSION['nama']) ?></b> | <a href="logout.php">Logout</a></p>
    <p><a href="tambah.php">+ Tambah Pelanggan</a></p>
    <table>
        <tr>
            <th>No</th><th>Nama</th><th>Email</th>
            <th>No. Telepon</th><th>Level Member</th><th>Bergabung</th><th>Aksi</th>
        </tr>
        <?php foreach ($daftar as $i => $p): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($p['nama']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>
            <td><?= htmlspecialchars($p['no_telepon']) ?></td>
            <td><?= htmlspecialchars($p['level_member']) ?></td>
            <td><?= $p['tanggal_bergabung'] ?></td>
            <td>
                                <a href="detail.php?id=<?= $p['id'] ?>">Detail</a> |
                <a href="ubah.php?id=<?= $p['id'] ?>">Ubah</a> |
                <form method="post" action="hapus.php"
                      onsubmit="return confirm('Hapus pelanggan ini?')">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button type="submit" class="hapus">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>