<?php
/**
 * Tambah User Process
 * Memproses form tambah user, password dienkripsi dengan bcrypt (paling aman)
 */
session_start();
require_once 'config/db.php';

// Cek apakah sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah_user.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi
if (empty($username) || empty($password)) {
    $_SESSION['form_error'] = 'Nama dan Password harus diisi!';
    header('Location: tambah_user.php');
    exit;
}

if (strlen($username) > 128) {
    $_SESSION['form_error'] = 'Nama maksimal 128 karakter!';
    header('Location: tambah_user.php');
    exit;
}

if (strlen($password) < 5 || strlen($password) > 8) {
    $_SESSION['form_error'] = 'Password harus minimal 5 dan maksimal 8 karakter!';
    header('Location: tambah_user.php');
    exit;
}

// Enkripsi password dengan bcrypt (metode paling aman)
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert ke database
$database = new db();
$database->insert(
    "INSERT INTO tbl_user (username, password, createtime) VALUES (?, ?, NOW())",
    [$username, $hashed_password]
);

$_SESSION['success_msg'] = 'User berhasil ditambahkan!';
header('Location: daftar_user.php');
exit;
?>
