<?php
/**
 * DAFTAR USER
 * Menampilkan daftar semua user dari tbl_user
 * Nilai: 20 poin (bagian dari CRUD)
 */
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['login_error'] = 'Silakan login terlebih dahulu!';
    header('Location: index.php');
    exit;
}

require_once 'config/db.php';

$database = new db();
$users = $database->select("SELECT * FROM tbl_user ORDER BY id ASC");

$success_msg = '';
if (isset($_SESSION['success_msg'])) {
    $success_msg = $_SESSION['success_msg'];
    unset($_SESSION['success_msg']);
}
$login_msg = '';
if (isset($_SESSION['login_success'])) {
    $login_msg = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            max-width: 700px;
            background: #fff;
            border: 1px solid #ccc;
            padding: 25px;
            margin: 0 auto;
        }
        h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        .success { color: green; font-weight: bold; margin: 10px 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background: #f0f0f0;
            font-weight: bold;
        }
        a { color: #333; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .actions a { margin-right: 5px; }
        .btn {
            display: inline-block;
            padding: 6px 15px;
            background: #e0e0e0;
            border: 1px solid #999;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            margin-top: 15px;
        }
        .btn:hover { background: #d0d0d0; }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .top-bar span { font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <a href="logout.php" class="btn">Logout</a>
        </div>

        <h2>DAFTAR USER</h2>

        <?php if ($login_msg): ?>
            <p class="success"><?php echo htmlspecialchars($login_msg); ?></p>
        <?php endif; ?>
        <?php if ($success_msg): ?>
            <p class="success"><?php echo htmlspecialchars($success_msg); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Ctime</th>
                    <th>Fungsi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) > 0): ?>
                    <?php $no = 1; foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td>Xxxx</td>
                            <td><?php echo date('d/n/Y', strtotime($user['createtime'])); ?></td>
                            <td class="actions">
                                <a href="ubah_user.php?id=<?php echo $user['id']; ?>">Edit</a> |
                                <a href="hapus_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus user ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="tambah_user.php" class="btn">+ Tambah User</a>
    </div>
</body>
</html>
