<?php
require 'auth.php';
require 'models/Pelanggan.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = (new Pelanggan())->cariByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        header('Location: index.php');
        exit;
    }
    $error = 'Email atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input { width: 280px; padding: 6px; margin-top: 4px; }
        .error { color: #c00; }
        button { margin-top: 16px; padding: 8px 16px; }
    </style>
</head>
<body>
    <h2>Login</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <label>Password</label>
        <input type="password" name="password">
        <br>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>