<?php
/**
 * FORM PENAMBAHAN USER
 * Form untuk menambahkan user baru
 */
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['login_error'] = 'Silakan login terlebih dahulu!';
    header('Location: index.php');
    exit;
}

$error = '';
if (isset($_SESSION['form_error'])) {
    $error = $_SESSION['form_error'];
    unset($_SESSION['form_error']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            max-width: 500px;
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
        .form-group {
            margin: 15px 0;
            display: flex;
            align-items: center;
        }
        .form-group label {
            width: 150px;
            font-size: 14px;
        }
        .form-group input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #999;
            font-size: 14px;
        }
        button {
            padding: 8px 30px;
            background: #e0e0e0;
            border: 1px solid #999;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin: 20px auto 0;
        }
        button:hover { background: #d0d0d0; }
        .error { color: red; font-weight: bold; margin: 10px 0; }
        .btn-back {
            display: inline-block;
            padding: 6px 15px;
            background: #e0e0e0;
            border: 1px solid #999;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            margin-top: 15px;
        }
        .btn-back:hover { background: #d0d0d0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>FORM PENAMBAHAN USER</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="tambah_process.php">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="username" required maxlength="128">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required minlength="5" maxlength="8"
                       placeholder="5-8 karakter">
            </div>
            <button type="submit">Submit</button>
        </form>

        <a href="daftar_user.php" class="btn-back">&laquo; Kembali ke Daftar User</a>
    </div>
</body>
</html>
