<?php
require 'auth.php';
wajibLogin();
require 'models/Pelanggan.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new Pelanggan())->hapus((int)($_POST['id'] ?? 0));
}
header('Location: index.php');
exit;