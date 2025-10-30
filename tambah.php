<?php
// ==============================
// Hubungkan ke file koneksi PDO
// ==============================
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/config/database.php';
if (!isset($pdo)) {
    die("❌ File koneksi ditemukan tapi variabel \$pdo tidak ada!");
}

// Variabel untuk menampung pesan status
$pesan = '';

// Jika form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama   = trim($_POST['nama'] ?? '');
    $posisi = trim($_POST['posisi'] ?? '');
    $klub   = trim($_POST['klub'] ?? '');

    // Validasi sederhana
    if ($nama && $posisi && $klub) {
        try {
            // Siapkan dan jalankan query
            $stmt = $pdo->prepare("INSERT INTO pemain (nama, posisi, klub) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $posisi, $klub]);
            $pesan = "✅ Data pemain berhasil ditambahkan!";
        } catch (PDOException $e) {
            $pesan = "❌ Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        $pesan = "⚠️ Semua kolom wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Pemain</title>
    <link rel="stylesheet" href="assets/2409106021_Rusdiana.css">
</head>
<body>
    <header>
        <h1>Tambah Data Pemain</h1>
        <nav>
            <ul>
                <li><a href="index.php">🏠 Kembali ke Home</a></li>
            </ul>
        </nav>
    </header>

    <main class="card">
        <form method="post">
            <label>Nama:</label><br>
            <input type="text" name="nama" required><br><br>

            <label>Posisi:</label><br>
            <input type="text" name="posisi" required><br><br>

            <label>Klub:</label><br>
            <input type="text" name="klub" required><br><br>

            <button class="btn btn-primary" type="submit">Tambah Data</button>
        </form>

        <?php if ($pesan): ?>
            <p class="pesan"><?= htmlspecialchars($pesan) ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 CRUD Rusdiana Project</p>
    </footer>
</body>
</html>
