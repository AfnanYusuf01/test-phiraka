# Test PHP + PostgreSQL

Aplikasi test menggunakan PHP murni dan PostgreSQL, terdiri dari 2 soal.

---

## 📁 Struktur Project

```
├── index.php                      # Halaman utama (navigasi ke Soal 1 & 2)
├── soal1/
│   └── index.php                  # SOAL 1: Fibonacci Table Generator
└── soal2/
    ├── config/
    │   └── db.php                 # Class db untuk koneksi PostgreSQL
    ├── captcha.php                # Security Image (Captcha) generator
    ├── index.php                  # Form Login
    ├── login_process.php          # Proses validasi login
    ├── daftar_user.php            # Halaman daftar user (SELECT)
    ├── tambah_user.php            # Form tambah user
    ├── tambah_process.php         # Proses tambah user (INSERT)
    ├── ubah_user.php              # Form edit user
    ├── ubah_process.php           # Proses edit user (UPDATE)
    ├── hapus_user.php             # Proses hapus user (DELETE)
    ├── logout.php                 # Logout session
    ├── setup.php                  # Setup tabel database
    └── seed.php                   # Seed user admin pertama
```

---

## ⚙️ Prasyarat

- **PHP** >= 7.4 (dengan extension: `pdo_pgsql`, `pgsql`, `gd`)
- **PostgreSQL** >= 12

### Mengaktifkan Extension PHP

Edit file `php.ini` dan pastikan baris berikut **tidak** di-comment:

```ini
extension=pdo_pgsql
extension=pgsql
extension=gd
```

---

## 🚀 Cara Menjalankan

### 1. Buat Database PostgreSQL

```sql
CREATE DATABASE db_test_p;
```

### 2. Buat Tabel

Jalankan via browser:
```
http://localhost:8080/soal2/setup.php
```

Atau jalankan SQL berikut:
```sql
CREATE TABLE IF NOT EXISTS tbl_user (
    id SERIAL PRIMARY KEY,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(255) NOT NULL,
    createtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Seed User Admin (untuk login pertama kali)

Jalankan via browser:
```
http://localhost:8080/soal2/seed.php
```

### 4. Jalankan PHP Built-in Server

```bash
php -S localhost:8080
```

### 5. Akses Aplikasi

| Halaman | URL |
|---------|-----|
| Halaman Utama | http://localhost:8080/ |
| Soal 1 - Fibonacci | http://localhost:8080/soal1/ |
| Soal 2 - Login | http://localhost:8080/soal2/ |

---

## 📋 SOAL 1 - Barisan Fibonacci dalam Format Tabel

Membuat barisan bilangan Fibonacci dalam format tabel. Jumlah baris dan kolom diset melalui inputan.

**Contoh bilangan Fibonacci:** 0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, ...

**Fitur:**
- Input jumlah rows dan columns
- Tombol Submit untuk generate tabel
- Tabel Fibonacci ditampilkan secara otomatis

---

## 📋 SOAL 2 - Aplikasi CRUD User dengan Login

Aplikasi sederhana yang terdiri dari:

1. **Form Login** - dengan fitur Security Image (Captcha)
2. **Form Daftar User** - menampilkan semua user
3. **Form Tambah User** - menambah user baru
4. **Form Ubah User** - mengubah data user
5. **Form Hapus User** - menghapus user

### Spesifikasi Detail

| Komponen | Detail | Nilai |
|----------|--------|-------|
| Class `db` | Class koneksi PostgreSQL menggunakan PDO | **30 poin** |
| CRUD Operations | Insert, Select, Update, Delete pada `tbl_user` | **20 poin** |
| Login System | Validasi username & password, output "LOGIN SUKSES" / "LOGIN GAGAL" | **10 poin** |
| Security Image | Captcha pada form login menggunakan GD Library | **40 poin** |

### Spesifikasi Tabel `tbl_user`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | SERIAL | Primary Key, Auto Increment |
| username | VARCHAR(128) | Nama user |
| password | VARCHAR(255) | Password ter-enkripsi (bcrypt) |
| createtime | TIMESTAMP | Waktu pembuatan |

### Keamanan

- **Password Encryption**: Menggunakan `password_hash()` dengan `PASSWORD_BCRYPT`
- **Password Verification**: Menggunakan `password_verify()` untuk cek login
- **Validasi Password**: Minimal 5 karakter, maksimal 8 karakter
- **Security Image**: Captcha dengan karakter acak dan noise untuk mencegah bot
- **Password Masking**: Di halaman daftar user, password ditampilkan sebagai "Xxxx"

---

## 🔑 Login Default

| Field | Value |
|-------|-------|
| Username | `admin` |
| Password | `admin123` |

---

## 🗄️ Konfigurasi Database

Konfigurasi database ada di file `soal2/config/db.php`:

```php
private $host   = 'localhost';
private $port   = '5432';
private $dbname = 'db_test_p';
private $user   = 'postgres';
private $pass   = '12345678';
```

Sesuaikan dengan konfigurasi PostgreSQL lokal Anda jika berbeda.
