<?php
/**
 * Hapus User
 * Menghapus user dari tbl_user berdasarkan ID
 */
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $database = new db();
    $database->delete("DELETE FROM tbl_user WHERE id = ?", [$id]);
    $_SESSION['success_msg'] = 'User berhasil dihapus!';
}

header('Location: daftar_user.php');
exit;
?>
