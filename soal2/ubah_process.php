<?php
/**
 * Ubah User Process
 * Memproses form ubah user
 */
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: daftar_user.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($id <= 0) {
    header('Location: daftar_user.php');
    exit;
}

if (empty($username)) {
    $_SESSION['form_error'] = 'Nama harus diisi!';
    header("Location: ubah_user.php?id=$id");
    exit;
}

if (strlen($username) > 128) {
    $_SESSION['form_error'] = 'Nama maksimal 128 karakter!';
    header("Location: ubah_user.php?id=$id");
    exit;
}

$database = new db();

if (!empty($password)) {
    if (strlen($password) < 5 || strlen($password) > 8) {
        $_SESSION['form_error'] = 'Password harus 5-8 karakter!';
        header("Location: ubah_user.php?id=$id");
        exit;
    }
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $database->update(
        "UPDATE tbl_user SET username = ?, password = ? WHERE id = ?",
        [$username, $hashed, $id]
    );
} else {
    $database->update(
        "UPDATE tbl_user SET username = ? WHERE id = ?",
        [$username, $id]
    );
}

$_SESSION['success_msg'] = 'User berhasil diubah!';
header('Location: daftar_user.php');
exit;
?>
