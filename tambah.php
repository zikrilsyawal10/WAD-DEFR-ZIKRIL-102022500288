<?php
require 'auth.php';
wajibLogin();
require 'models/Pelanggan.php';

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

    if ($data['nama'] === '' || $data['email'] === '' || $data['password'] === '') {
        $error = 'Nama, email, dan password wajib diisi.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif (!in_array($data['level_member'], ['Basic', 'Gold', 'VIP'])) {
        $error = 'Level member tidak valid.';
    } else {
        try {
            (new Pelanggan())->tambah($data);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = ($e->getCode() == 23000)
                ? 'Email sudah terdaftar.'
                : 'Gagal menyimpan data.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select, textarea { width: 320px; padding: 6px; margin-top: 4px; }
        .error { color: #c00; margin-top: 10px; }
        button { margin-top: 16px; padding: 8px 16px; }
    </style>
</head>
<body>
    <h2>Tambah Pelanggan</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

        <label>Password</label>
        <input type="password" name="password">

        <label>No. Telepon</label>
        <input type="text" name="no_telepon" value="<?= htmlspecialchars($_POST['no_telepon'] ?? '') ?>">

        <label>Alamat</label>
        <textarea name="alamat" rows="3"><?= htmlspecialchars($_POST['alamat'] ?? '') ?></textarea>

        <label>Level Member</label>
        <select name="level_member">
            <option>Basic</option>
            <option>Gold</option>
            <option>VIP</option>
        </select>

        <br>
        <button type="submit">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>