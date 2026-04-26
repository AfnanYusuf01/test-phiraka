<?php
/**
 * FORM LOGIN
 * Halaman login dengan Security Image (Captcha)
 * Nilai: 10 poin (login) + 40 poin (security image)
 */
session_start();

// Jika sudah login, redirect ke daftar user
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: daftar_user.php');
    exit;
}

$error = '';
$success = '';

if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
if (isset($_SESSION['login_success'])) {
    $success = $_SESSION['login_success'];
    unset($_SESSION['login_success']);
}

$last_username = isset($_SESSION['last_username']) ? $_SESSION['last_username'] : '';

// Generate captcha langsung di sini dan simpan di session
$characters = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
$captcha_text = '';
for ($i = 0; $i < 5; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $captcha_text;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
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
            align-items: flex-start;
        }
        .form-group label {
            width: 180px;
            padding-top: 8px;
            font-size: 14px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #999;
            font-size: 14px;
        }
        .captcha-display {
            border-bottom: 2px solid #333;
            padding: 10px 5px;
            display: flex;
            gap: 15px;
            font-size: 20px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            letter-spacing: 5px;
            user-select: none;
        }
        .captcha-display span {
            display: inline-block;
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
        .error { color: red; font-weight: bold; margin: 10px 0; text-align: center; }
        .success { color: green; font-weight: bold; margin: 10px 0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>FORM LOGIN</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <form method="post" action="login_process.php">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="username" required maxlength="128"
                       value="<?php echo htmlspecialchars($last_username); ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required minlength="5" maxlength="8">
            </div>
            <div class="form-group">
                <label>Security Image</label>
                <div class="captcha-display">
                    <?php for ($i = 0; $i < strlen($captcha_text); $i++): ?>
                        <span><?php echo $captcha_text[$i]; ?></span>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Input karakter yang muncul pada tampilan diatas</label>
                <input type="text" name="captcha" required maxlength="5"
                       style="text-transform: uppercase;"
                       autocomplete="off">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
