<?php
/**
 * Seed User - Membuat user pertama untuk bisa login
 * Jalankan sekali setelah setup.php
 */
require_once 'config/db.php';

$database = new db();

$username = 'admin';
$password = password_hash('admin123', PASSWORD_BCRYPT);

$database->insert(
    "INSERT INTO tbl_user (username, password, createtime) VALUES (?, ?, NOW())",
    [$username, $password]
);

echo "<h2>User seed berhasil!</h2>";
echo "<p>Username: <strong>admin</strong></p>";
echo "<p>Password: <strong>admin123</strong></p>";
echo '<p><a href="index.php">Login sekarang</a></p>';
?>
