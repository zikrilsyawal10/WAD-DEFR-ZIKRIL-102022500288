<?php
require 'auth.php';
wajibLogin();
require 'models/Pelanggan.php';

$model = new Pelanggan();
$id = (int)($_GET['id'] ?? 0);
$p = $model->cari($id);
if (!$p) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nama'         => trim($_POST['nama'] ?? ''),
        'email'        => trim($_POST['email'] ?? ''),
        'password'     => $_POST['password'] ?? '',
        'no_telepon'   => trim($_POST['no_telepon'] ?? ''),
        'alamat'       => trim($_POST['alamat'] ?? ''),
        'level_member' => $_POST['level_member'] ?? 'Basic',
    ];
    $p = array_merge($p, $data);

    if ($data['nama'] === '' || $data['email'] === '') {
        $error = 'Nama dan email wajib diisi.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif (!in_array($data['level_member'], ['Basic', 'Gold', 'VIP'])) {
        $error = 'Level member tidak valid.';
    } else {
        try {
            $model->ubah($id, $data);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = ($e->getCode() == 23000)
                ? 'Email sudah dipakai pelanggan lain.'
                : 'Gagal menyimpan data.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select, textarea { width: 320px; padding: 6px; margin-top: 4px; }
        .error { color: #c00; margin-top: 10px; }
        small { color: #666; }
        button { margin-top: 16px; padding: 8px 16px; }
    </style>
</head>
<body>
    <h2>Ubah Pelanggan</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($p['nama']) ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($p['email']) ?>">

        <label>Password baru</label>
        <input type="password" name="password">
        <small>Kosongkan jika tidak ingin mengganti password.</small>

        <label>No. Telepon</label>
        <input type="text" name="no_telepon" value="<?= htmlspecialchars($p['no_telepon'] ?? '') ?>">

        <label>Alamat</label>
        <textarea name="alamat" rows="3"><?= htmlspecialchars($p['alamat'] ?? '') ?></textarea>

        <label>Level Member</label>
        <select name="level_member">
            <?php foreach (['Basic', 'Gold', 'VIP'] as $lv): ?>
                <option <?= $p['level_member'] === $lv ? 'selected' : '' ?>><?= $lv ?></option>
            <?php endforeach; ?>
        </select>

        <br>
        <button type="submit">Simpan Perubahan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>