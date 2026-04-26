<?php
/**
 * Security Image (Captcha) Generator
 * Menghasilkan gambar captcha dengan karakter acak
 * Nilai: 40 poin
 */
session_start();

// Generate random captcha text (campuran huruf dan angka)
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
$captcha_text = '';
$length = 5; // panjang karakter captcha

for ($i = 0; $i < $length; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

// Simpan captcha text ke session
$_SESSION['captcha'] = $captcha_text;

// Buat gambar captcha
$width = 180;
$height = 50;
$image = imagecreatetruecolor($width, $height);

// Warna-warna
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 150, 150, 150);
$noise_color = imagecolorallocate($image, 200, 200, 200);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Tambahkan garis-garis noise
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Tambahkan titik-titik noise
for ($i = 0; $i < 100; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
}

// Tulis karakter captcha satu per satu dengan posisi acak
$font_size = 5; // built-in font size (1-5)
$x = 15;
for ($i = 0; $i < strlen($captcha_text); $i++) {
    $y = rand(10, 25);
    imagestring($image, $font_size, $x, $y, $captcha_text[$i], $text_color);
    $x += 30;
}

// Output gambar sebagai PNG
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
imagepng($image);
imagedestroy($image);
?>
