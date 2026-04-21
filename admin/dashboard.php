\<?php 
include '../config.php'; 

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #e0e1e4;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #1f2937;
            color: white;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            color: #fff;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 14px 25px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #374151;
            color: #fff;
        }

        /* Content */
        .main-content {
            margin-left: 240px;
            padding: 30px;
            width: 100%;
        }

        .main-content h1 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card p {
            color: #4b5563;
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_soal.php">Kelola Soal</a>
        <a href="data_maba.php">Data Maba</a>
        <a href="hasil_ujian.php">Hasil Ujian</a> 
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Dashboard Admin</h1>
        <div class="card">
            <p>Selamat datang di halaman admin. Silakan pilih menu di sidebar kiri.</p>
        </div>
    </div>

</body>
</html>