<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require __DIR__ . '/config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('❌ ID tidak ditemukan!');
}

try {
    $stmt = $pdo->prepare("DELETE FROM pemain WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?hapus=berhasil");
    exit;
} catch (PDOException $e) {
    die("❌ Gagal menghapus data: " . $e->getMessage());
}
?>
