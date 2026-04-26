<?php
/**
 * SOAL 1 - Barisan Bilangan Fibonacci dalam Format Tabel
 * Jumlah baris dan kolom diset melalui inputan
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 1 - Fibonacci Table</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        h2 { margin-bottom: 20px; color: #333; }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }
        .form-group input {
            padding: 8px 12px;
            border: 1px solid #999;
            width: 100px;
            font-size: 14px;
        }
        button {
            padding: 8px 30px;
            background: #e0e0e0;
            border: 1px solid #999;
            cursor: pointer;
            font-size: 14px;
            margin-left: 100px;
            margin-top: 5px;
        }
        button:hover { background: #d0d0d0; }
        table {
            border-collapse: collapse;
            margin-top: 25px;
        }
        td {
            border: 1px solid #333;
            padding: 10px 18px;
            text-align: center;
            font-size: 15px;
            min-width: 50px;
        }
    </style>
</head>
<body>
    <h2>SOAL 1 - Barisan Fibonacci dalam Format Tabel</h2>

    <form method="post" action="">
        <div class="form-group">
            <label>Rows</label>
            <input type="number" name="rows" min="1" value="<?php echo isset($_POST['rows']) ? (int)$_POST['rows'] : 6; ?>" required>
        </div>
        <div class="form-group">
            <label>Columns</label>
            <input type="number" name="cols" min="1" value="<?php echo isset($_POST['cols']) ? (int)$_POST['cols'] : 6; ?>" required>
        </div>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rows = (int)$_POST['rows'];
        $cols = (int)$_POST['cols'];
        $total = $rows * $cols;

        // Generate Fibonacci sequence
        $fib = [];
        for ($i = 0; $i < $total; $i++) {
            if ($i == 0) {
                $fib[] = 0;
            } elseif ($i == 1) {
                $fib[] = 1;
            } else {
                $fib[] = $fib[$i - 1] + $fib[$i - 2];
            }
        }

        // Display as table
        echo '<table>';
        $index = 0;
        for ($r = 0; $r < $rows; $r++) {
            echo '<tr>';
            for ($c = 0; $c < $cols; $c++) {
                echo '<td>' . $fib[$index] . '</td>';
                $index++;
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>
</html>
