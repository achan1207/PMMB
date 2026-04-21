<?php 
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$pesan = "";

if(isset($_GET['hapus'])){
    $id = (int) $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM users WHERE id=$id");

    if($hapus){
        $pesan = "<div class='alert success'>Data mahasiswa berhasil dihapus.</div>";
    } else {
        $pesan = "<div class='alert danger'>Gagal menghapus data mahasiswa.</div>";
    }
}

$q = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Maba</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            display:flex;
            background:#e0e1e4;
            min-height:100vh;
        }

        /* Sidebar */
        .sidebar{
            width:240px;
            background:#1f2937;
            color:white;
            min-height:100vh;
            padding:20px 0;
            position:fixed;
            left:0;
            top:0;
        }

        .sidebar h2{
            text-align:center;
            margin-bottom:30px;
            font-size:22px;
        }

        .sidebar a{
            display:block;
            color:#d1d5db;
            text-decoration:none;
            padding:14px 25px;
            transition:0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active{
            background:#374151;
            color:white;
        }

        /* Main Content */
        .main-content{
            margin-left:240px;
            padding:30px;
            width:100%;
        }

        .main-content h1{
            font-size:28px;
            color:#111827;
            margin-bottom:20px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
            margin-bottom:25px;
        }

        .card h2{
            margin-bottom:20px;
            color:#1f2937;
        }

        .alert{
            padding:12px 15px;
            margin-bottom:20px;
            border-radius:5px;
            font-size:14px;
        }

        .success{
            background:#d4edda;
            color:#155724;
        }

        .danger{
            background:#f8d7da;
            color:#721c24;
        }

        .table-wrap{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th, table td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }

        table th{
            background:#f1f1f1;
        }

        .btn{
            display:inline-block;
            padding:8px 14px;
            border:none;
            border-radius:5px;
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
        }

        .btn-danger{
            background:#dc3545;
            color:white;
        }

        .btn-danger:hover{
            background:#c82333;
        }

        .badge{
            display:inline-block;
            padding:5px 10px;
            border-radius:4px;
            font-size:13px;
            font-weight:bold;
            background:#dbeafe;
            color:#1d4ed8;
        }

        @media(max-width:768px){
            .sidebar{
                width:200px;
            }

            .main-content{
                margin-left:200px;
                padding:20px;
            }

            table th, table td{
                font-size:13px;
                padding:10px;
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
        <a href="data_maba.php" class="active">Data Maba</a>
        <a href="hasil_ujian.php">Hasil Ujian</a> 
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Data Mahasiswa Baru</h1>

        <?= $pesan ?>

        <div class="card">
            <h2>Daftar Peserta</h2>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Ujian</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($r = mysqli_fetch_assoc($q)){ 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($r['nama']) ?></td>
                            <td><span class="badge"><?= htmlspecialchars($r['no_ujian']) ?></span></td>
                            <td><?= htmlspecialchars($r['email']) ?></td>
                            <td>
                                <a href="?hapus=<?= $r['id'] ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>