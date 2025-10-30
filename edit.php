<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require __DIR__ . '/config/database.php';

$id = $_GET['id'] ?? null;
$pesan = '';

if (!$id) {
    die('❌ ID tidak ditemukan!');
}

// Ambil data pemain berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM pemain WHERE id = ?");
$stmt->execute([$id]);
$pemain = $stmt->fetch();

if (!$pemain) {
    die('❌ Data pemain tidak ditemukan!');
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $posisi = trim($_POST['posisi'] ?? '');
    $klub = trim($_POST['klub'] ?? '');

    if ($nama && $posisi && $klub) {
        try {
            $update = $pdo->prepare("UPDATE pemain SET nama=?, posisi=?, klub=? WHERE id=?");
            $update->execute([$nama, $posisi, $klub, $id]);
            $pesan = "✅ Data pemain berhasil diperbarui!";
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
<title>Edit Data Pemain</title>
<link rel="stylesheet" href="assets/2409106021_Rusdiana.css">
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #0b1e64, #a50044);
    color: #fff;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Kartu form 3D */
form {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 35px 40px;
    width: 400px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4), inset 0 0 20px rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
    animation: fadeIn 0.8s ease;
}

/* Efek kilau di belakang kartu */
form::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.15), transparent 70%);
    animation: shine 6s linear infinite;
    pointer-events: none;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    text-shadow: 0 0 10px rgba(255,255,255,0.4);
}

/* Input */
input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: none;
    border-radius: 10px;
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: 15px;
    box-shadow: inset 2px 2px 8px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
input:focus {
    background: rgba(255,255,255,0.3);
    outline: none;
    box-shadow: 0 0 10px rgba(255,255,255,0.4);
}

/* Tombol 3D */
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: linear-gradient(145deg, #004aad, #c2002f);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
    box-shadow: 0 5px 12px rgba(0,0,0,0.5);
    transition: transform 0.25s, box-shadow 0.25s;
}
button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.6);
}

/* Pesan */
.msg {
    text-align: center;
    margin-top: 15px;
    font-weight: bold;
    color: #fff;
}

/* Link kembali */
a {
    display: inline-block;
    text-align: center;
    margin-top: 20px;
    padding: 10px 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s;
}
a:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

/* Animasi */
@keyframes shine {
    0% { transform: translate(0,0); opacity: 0.4; }
    50% { transform: translate(25%,25%); opacity: 0.8; }
    100% { transform: translate(0,0); opacity: 0.4; }
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

<form method="post">
    <h2>Edit Data Pemain</h2>

    <label>Nama:</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($pemain['nama']) ?>" required>

    <label>Posisi:</label>
    <input type="text" name="posisi" value="<?= htmlspecialchars($pemain['posisi']) ?>" required>

    <label>Klub:</label>
    <input type="text" name="klub" value="<?= htmlspecialchars($pemain['klub']) ?>" required>

    <button type="submit">💾 Simpan Perubahan</button>

    <div class="msg">
        <?php if ($pesan) echo htmlspecialchars($pesan); ?>
    </div>

    <div style="text-align:center;">
        <a href="index.php">⬅️ Kembali ke Halaman Utama</a>
    </div>
</form>

</body>
</html>
