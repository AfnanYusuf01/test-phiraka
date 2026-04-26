<?php
/**
 * Security Image (Captcha) Generator
 * Menghasilkan gambar captcha dengan karakter acak
 * Nilai: 40 poin
 */

// Harus mulai session SEBELUM output apapun
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate random captcha text (campuran huruf dan angka)
// Menggunakan karakter yang mudah dibaca (menghilangkan O, I, L yang mirip 0, 1)
$characters = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
$captcha_text = '';
$length = 5;

for ($i = 0; $i < $length; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

// Simpan captcha text ke session
$_SESSION['captcha'] = $captcha_text;
session_write_close(); // Pastikan session tersimpan segera

// Buat gambar captcha
$width = 200;
$height = 60;
$image = imagecreatetruecolor($width, $height);

// Warna-warna
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 180, 180, 180);
$noise_color = imagecolorallocate($image, 200, 200, 200);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Tambahkan garis-garis noise
for ($i = 0; $i < 4; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Tambahkan titik-titik noise
for ($i = 0; $i < 80; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
}

// Tulis karakter captcha satu per satu — lebih besar dan jelas
$font_size = 5; // built-in font size (1-5)
$x = 20;
for ($i = 0; $i < strlen($captcha_text); $i++) {
    $y = rand(15, 30);
    imagestring($image, $font_size, $x, $y, $captcha_text[$i], $text_color);
    $x += 34;
}

// Output gambar sebagai PNG
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
imagepng($image);
imagedestroy($image);
?>
