<?php
/**
 * Login Process
 * Memproses form login, validasi captcha, cek username & password
 */
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$captcha_input = strtoupper(trim($_POST['captcha'] ?? ''));

// Simpan username terakhir untuk ditampilkan kembali jika gagal
$_SESSION['last_username'] = $username;

// Ambil captcha dari session
$captcha_stored = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';

// Hapus captcha dari session (agar tidak bisa dipakai ulang)
unset($_SESSION['captcha']);

// Validasi captcha
if (empty($captcha_stored) || $captcha_input !== $captcha_stored) {
    $_SESSION['login_error'] = 'LOGIN GAGAL - Security Image tidak sesuai!';
    header('Location: index.php');
    exit;
}

// Validasi input
if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'LOGIN GAGAL - Username dan Password harus diisi!';
    header('Location: index.php');
    exit;
}

// Validasi panjang password (min 5, max 8)
if (strlen($password) < 5 || strlen($password) > 8) {
    $_SESSION['login_error'] = 'LOGIN GAGAL - Password harus 5-8 karakter!';
    header('Location: index.php');
    exit;
}

// Cek username dan password di database
$database = new db();
$result = $database->select("SELECT * FROM tbl_user WHERE username = ?", [$username]);

if (count($result) > 0) {
    $user = $result[0];
    // Verifikasi password menggunakan password_verify (bcrypt)
    if (password_verify($password, $user['password'])) {
        // LOGIN SUKSES
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['login_success'] = 'LOGIN SUKSES';
        unset($_SESSION['last_username']);

        header('Location: daftar_user.php');
        exit;
    }
}

// LOGIN GAGAL - username atau password salah
$_SESSION['login_error'] = 'LOGIN GAGAL';
header('Location: index.php');
exit;
?>
