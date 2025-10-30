<?php
require __DIR__ . '/config/database.php';


// ====== Konfigurasi pagination ======
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// ====== Fitur pencarian ======
$keyword = trim($_GET['keyword'] ?? '');
$where = '';
$params = [];

if ($keyword !== '') {
    $where = "WHERE nama LIKE ? OR klub LIKE ?";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

// ====== Hitung total data ======
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM pemain $where");
$totalStmt->execute($params);
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// ====== Ambil data pemain ======
$sql = "SELECT * FROM pemain $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$pemain = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemain - CRUD Rusdiana</title>
    <link rel="stylesheet" href="assets/2409106021_Rusdiana.css">
    <style>
        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 8px 12px;
            border: 1px solid #007bff;
            color: #007bff;
            text-decoration: none;
            margin: 0 3px;
            border-radius: 5px;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
        }
        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>
<header>
    <h1>Daftar Pemain Sepak Bola</h1>
    <p>👋 Halo, <?= htmlspecialchars($_SESSION['user'] ?? 'User') ?> | 
       <a href="logout.php" class="btn-danger">Logout</a>
    </p>

<header>
    <h1>Daftar Pemain Sepak Bola</h1>
</header>

<div class="search-box">
    <form method="get" action="">
        <input type="text" name="keyword" placeholder="Cari nama atau klub..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn-primary">Cari</button>
        <a href="tambah.php" class="btn-success">+ Tambah Pemain</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Klub</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($pemain): ?>
            <?php foreach ($pemain as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['posisi']) ?></td>
                    <td><?= htmlspecialchars($row['klub']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn-primary">👁️ Detail</a>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-success">✏️ Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 CRUD PHP Rusdiana | Sistem Informasi - Posttest 4</p>
</footer>

</body>
</html>
