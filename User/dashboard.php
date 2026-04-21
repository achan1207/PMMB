<?php
include '../config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['user']['nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #f4f6f9;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #ffffff;
            border-right: 1px solid #ddd;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-top h2 {
            font-size: 24px;
            color: #222;
            margin-bottom: 30px;
        }

        .profile-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-box img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #ddd;
        }

        .profile-box h3 {
            font-size: 18px;
            color: #333;
        }

        .profile-box p {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .menu a {
            text-decoration: none;
            color: #333;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 16px;
        }

        .menu a:hover,
        .menu a.active {
            background: #e9ecef;
            color: #000;
        }

        .logout-btn {
            text-decoration: none;
            background: #dc3545;
            color: white;
            text-align: center;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #b52a37;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            padding: 20px 30px;
            border-bottom: 1px solid #ddd;
        }

        .topbar h1 {
            font-size: 26px;
            color: #222;
        }

        .content {
            padding: 30px;
        }

        .welcome-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .welcome-card h2 {
            font-size: 28px;
            color: #222;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 16px;
            color: #555;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: #222;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-4px);
            background: #f8f9fa;
        }

        .card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #666;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            .menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .menu a {
                flex: 1 1 45%;
                text-align: center;
            }

            .logout-btn {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>User Panel</h2>

            <div class="profile-box">
                <a href="profil.php">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile">
                </a>
                <h3><?= htmlspecialchars($nama) ?></h3>
                <p>Calon Mahasiswa</p>
            </div>

            <div class="menu">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="profil.php">Profil</a>
                <a href="ujian.php">Ujian</a>
            </div>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="topbar">
            <h1>Dashboard User</h1>
        </div>

        <div class="content">
            <div class="welcome-card">
                <h2>Selamat Datang</h2>
                <p>Halo, <b><?= htmlspecialchars($nama) ?></b>. Selamat datang di sistem pendaftaran Universitas Al Ahzan.</p>
            </div>

            <div class="card-grid">
                <a href="ujian.php" class="card">
                    <h3>Ujian</h3>
                    <p>Masuk ke halaman ujian seleksi</p>
                </a>

                <a href="profil.php" class="card">
                    <h3>Profil</h3>
                    <p>Lihat dan edit data profil kamu</p>
                </a>
            </div>
        </div>
    </div>

</body>
</html>