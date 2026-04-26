<?php
/**
 * Setup Database - Jalankan file ini sekali untuk membuat tabel tbl_user
 * Pastikan database db_test_p sudah dibuat di PostgreSQL
 */
require_once 'config/db.php';

$database = new db();
$conn = $database->getConnection();

// Buat tabel tbl_user sesuai spesifikasi soal
// PostgreSQL menggunakan SERIAL untuk auto_increment
$sql = "
CREATE TABLE IF NOT EXISTS tbl_user (
    id SERIAL PRIMARY KEY,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    createtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

try {
    $conn->exec($sql);
    echo "<h2>Setup berhasil!</h2>";
    echo "<p>Tabel <strong>tbl_user</strong> berhasil dibuat di database <strong>db_test_p</strong>.</p>";
    echo '<p><a href="index.php">Kembali ke halaman Login</a></p>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
