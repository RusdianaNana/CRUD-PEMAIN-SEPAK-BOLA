<?php
require __DIR__ . '/config/database.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) { die('❌ ID pemain tidak ditemukan.'); }

try {
    $stmt = $pdo->prepare("SELECT * FROM pemain WHERE id = ?");
    $stmt->execute([$id]);
    $pemain = $stmt->fetch();
} catch (PDOException $e) {
    die("❌ Terjadi kesalahan: Gagal mengambil data.");
}

if (!$pemain) { die('⚠️ Data pemain tidak ditemukan di database.'); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Pemain</title>
<link rel="stylesheet" href="assets/2409106021_Rusdiana.css">
<style>
body {
    background: linear-gradient(135deg, #0b1e64, #a50044);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Kartu utama */
.detail-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);
    border-radius: 20px;
    padding: 30px 40px;
    width: 420px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    animation: fadeIn 0.8s ease;
    position: relative;
    overflow: hidden;
}

/* Efek kilau latar belakang */
.detail-card::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.15), transparent 60%);
    animation: shine 5s linear infinite;
    pointer-events: none; /* 🟢 ini penting agar tombol tetap bisa diklik */
}

/* Heading */
.detail-card h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
    text-shadow: 0 0 8px rgba(255,255,255,0.5);
}

/* Teks detail */
.detail-item {
    margin-bottom: 12px;
    font-size: 17px;
    border-left: 4px solid #c2002f;
    padding-left: 10px;
}

/* Tombol kembali */
.btn-back {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 25px;
    padding: 12px;
    background: linear-gradient(145deg, #004aad, #c2002f);
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    transition: transform 0.25s, box-shadow 0.25s;
}
.btn-back:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.5);
}

/* Animasi */
@keyframes shine {
    0% { transform: translate(0,0); opacity: 0.4; }
    50% { transform: translate(25%,25%); opacity: 0.8; }
    100% { transform: translate(0,0); opacity: 0.4; }
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>
<div class="detail-card">
    <h2>Detail Pemain</h2>
    <div class="detail-item"><strong>ID:</strong> <?= htmlspecialchars($pemain['id']) ?></div>
    <div class="detail-item"><strong>Nama:</strong> <?= htmlspecialchars($pemain['nama']) ?></div>
    <div class="detail-item"><strong>Posisi:</strong> <?= htmlspecialchars($pemain['posisi']) ?></div>
    <div class="detail-item"><strong>Klub:</strong> <?= htmlspecialchars($pemain['klub']) ?></div>
    <div class="detail-item"><strong>Dibuat pada:</strong> <?= htmlspecialchars($pemain['created_at']) ?></div>
    <a href="index.php" class="btn-back">⬅️ Kembali ke Daftar Pemain</a>
</div>
</body>
</html>
