Oke 👍 berikut versi **README.md** dengan **deskripsi yang lebih panjang dan lebih lengkap**, biar terlihat profesional dan memenuhi kriteria tugas kuliah juga 👇

---

# ⚽ BARCA PLAYER CRUD – Sistem Manajemen Pemain Barcelona

## 📋 Deskripsi Singkat

**BARCA PLAYER CRUD** adalah sebuah aplikasi web berbasis **PHP dan MySQL** yang dirancang untuk membantu pengguna dalam mengelola data pemain klub sepak bola **FC Barcelona** secara efisien.
Aplikasi ini dibuat sebagai bagian dari **tugas Web A24**, dengan mengimplementasikan konsep dasar **CRUD (Create, Read, Update, Delete)** dalam pengembangan aplikasi web dinamis.

Proyek ini tidak hanya menampilkan data pemain, tetapi juga memungkinkan pengguna untuk menambah, mengedit, menghapus, serta melihat detail informasi pemain secara interaktif.
Selain itu, sistem dilengkapi dengan fitur **login sederhana** untuk menjaga keamanan akses data. Desain tampilan dibuat dengan HTML dan CSS agar mudah digunakan serta responsif di berbagai ukuran layar.

Dengan memanfaatkan kombinasi antara **frontend (HTML, CSS)** dan **backend (PHP, MySQL)**, aplikasi ini menjadi contoh nyata dari integrasi antara tampilan antarmuka dan logika pemrosesan data dalam satu sistem web yang utuh.
Tujuan akhirnya adalah agar mahasiswa dapat menguasai dasar-dasar pengelolaan database melalui web serta memahami cara kerja koneksi antara PHP dan MySQL.

---

## ✨ Fitur yang Tersedia

* 🧾 **Menampilkan daftar pemain**
* ➕ **Menambahkan pemain baru**
* 🖊️ **Mengedit data pemain**
* ❌ **Menghapus pemain**
* 🔍 **Melihat detail pemain**
* 🔐 **Login & Session User**
* 💾 **Koneksi database dinamis**
* 🎨 **Tampilan sederhana dan mudah dipahami**

---

## 🧠 Kebutuhan Sistem

| Komponen       | Rekomendasi              |
| -------------- | ------------------------ |
| PHP            | ≥ 8.0                    |
| MySQL          | ≥ 8.0                    |
| Web Server     | Apache (Laragon / XAMPP) |
| Browser        | Chrome / Edge terbaru    |
| Sistem Operasi | Windows 10/11            |

---

## ⚙️ Cara Instalasi dan Konfigurasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/RusdianaNana/PEMROGRAMAN-WEB-A24.git
   ```

2. **Pindahkan ke folder server**

   ```
   C:\laragon\www\
   ```

   atau

   ```
   C:\xampp\htdocs\
   ```

3. **Import database**

   * Buka **phpMyAdmin**
   * Buat database baru, misal: `barca_db`
   * Import file `barca_db.sql` dari folder proyek

4. **Konfigurasi koneksi database**
   Buka file:

   ```php
   config/database.php
   ```

   Lalu sesuaikan:

   ```php
   $host = 'localhost';
   $db   = 'barca_db';
   $user = 'root';
   $pass = '';
   ```

5. **Jalankan Server**

   * Aktifkan **Apache** dan **MySQL** di Laragon atau XAMPP.
   * Buka browser dan akses:

     ```
     http://localhost/PEMROGRAMAN-WEB-A24
     ```

---

## 🧩 Struktur Folder

```
📦 PEMROGRAMAN-WEB-A24
 ┣ 📂 assets
 ┃ ┗ 📄 2409106021_Rusdiana.css
 ┣ 📂 config
 ┃ ┗ 📄 database.php
 ┣ 📄 index.php
 ┣ 📄 login.php
 ┣ 📄 edit.php
 ┣ 📄 detail.php
 ┣ 📄 delete.php
 ┣ 📄 logout.php
 ┣ 📄 README.md
 ┗ 📄 barca_db.sql
```

---

## ⚙️ Contoh File Environment Config

```php
<?php
$host = 'localhost';
$dbname = 'barca_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
```

---

## 🖼️ Screenshot Aplikasi

### 🏠 Halaman Daftar Pemain

<img width="1897" height="875" alt="image" src="https://github.com/user-attachments/assets/7d7088ce-18ad-4efc-8df9-8b5f57890b46" />

### ✏️ Halaman Edit Pemain

<img width="1918" height="871" alt="image" src="https://github.com/user-attachments/assets/90f0e94a-9fab-45cc-a839-d86ca1bde085" />

---

## 👩‍💻 Pengembang

**Nama:** Rusdiana Nana
**NIM:** 2409106021
**Kelas:** Pemrograman Web A24

---
