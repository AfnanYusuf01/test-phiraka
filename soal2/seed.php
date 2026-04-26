<?php
/**
 * Seed User - Membuat user admin untuk login
 * Jalankan sekali setelah setup.php
 */
require_once 'config/db.php';

$database = new db();

// Cek apakah admin sudah ada
$existing = $database->select("SELECT id FROM tbl_user WHERE username = ?", ['admin']);
if (count($existing) > 0) {
    echo "User admin sudah ada (ID: {$existing[0]['id']})\n";
} else {
    $username = 'admin';
    $plain_password = 'admin123';
    $hashed = password_hash($plain_password, PASSWORD_BCRYPT);

    echo "Plain password: $plain_password\n";
    echo "Hashed password: $hashed\n";
    echo "Hash length: " . strlen($hashed) . "\n";
    echo "Verify test: " . (password_verify($plain_password, $hashed) ? 'OK' : 'FAIL') . "\n\n";

    $database->insert(
        "INSERT INTO tbl_user (username, password, createtime) VALUES (?, ?, NOW())",
        [$username, $hashed]
    );

    // Verifikasi data tersimpan dengan benar
    $check = $database->select("SELECT * FROM tbl_user WHERE username = ?", ['admin']);
    if (count($check) > 0) {
        echo "Stored hash: " . $check[0]['password'] . "\n";
        echo "Stored hash length: " . strlen($check[0]['password']) . "\n";
        echo "Verify from DB: " . (password_verify($plain_password, $check[0]['password']) ? 'OK' : 'FAIL') . "\n";
        echo "\nUser admin berhasil dibuat!\n";
        echo "Username: admin\n";
        echo "Password: admin123\n";
    } else {
        echo "ERROR: Gagal menyimpan user!\n";
    }
}
?>
