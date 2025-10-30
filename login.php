<?php
require __DIR__ . '/config/database.php';
session_start();

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $user['password'] === md5($password)) {
            $_SESSION['user'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $pesan = "❌ Username atau password salah!";
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
    <title>Login - CRUD Rusdiana</title>
    <link rel="stylesheet" href="assets/2409106021_Rusdiana.css">
    <style>
        .login-box {
            width: 380px;
            margin: 100px auto;
            padding: 25px;
            border-radius: 15px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.4);
            text-align: center;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        button {
            background: linear-gradient(145deg, #004aad, #c2002f);
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 90%;
        }
        button:hover { opacity: 0.9; }
        .msg { margin-top: 10px; color: #ffd; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <?php if ($pesan): ?>
            <p class="msg"><?= htmlspecialchars($pesan) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
