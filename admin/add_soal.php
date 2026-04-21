<?php 
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$pesan = "";

if(isset($_POST['simpan'])){
    $p = mysqli_real_escape_string($conn, trim($_POST['p']));
    $f = mysqli_real_escape_string($conn, trim($_POST['fakultas']));
    $a = mysqli_real_escape_string($conn, trim($_POST['a']));
    $b = mysqli_real_escape_string($conn, trim($_POST['b']));
    $c = mysqli_real_escape_string($conn, trim($_POST['c']));
    $d = mysqli_real_escape_string($conn, trim($_POST['d']));
    $j = strtoupper(trim(mysqli_real_escape_string($conn, $_POST['j'])));

    // validasi jawaban
    if(!in_array($j, ['A','B','C','D'])){
        $pesan = "<div class='alert danger'>Jawaban harus A, B, C, atau D.</div>";
    } elseif(empty($p) || empty($f) || empty($a) || empty($b) || empty($c) || empty($d)) {
        $pesan = "<div class='alert danger'>Semua field wajib diisi.</div>";
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO soal (pertanyaan,fakultas,a,b,c,d,jawaban) 
        VALUES ('$p','$f','$a','$b','$c','$d','$j')");

        if($simpan){
            $pesan = "<div class='alert success'>Soal berhasil ditambahkan.</div>";
        } else {
            $pesan = "<div class='alert danger'>Gagal menambahkan soal: " . mysqli_error($conn) . "</div>";
        }
    }
}

if(isset($_GET['hapus'])){
    $id = (int) $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM soal WHERE id=$id");

    if($hapus){
        header("Location: add_soal.php?msg=hapus");
        exit;
    } else {
        $pesan = "<div class='alert danger'>Gagal menghapus soal.</div>";
    }
}

if(isset($_GET['msg']) && $_GET['msg'] == 'hapus'){
    $pesan = "<div class='alert success'>Soal berhasil dihapus.</div>";
}

$q = mysqli_query($conn, "SELECT * FROM soal ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal</title>
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

        .form-group{
            margin-bottom:15px;
        }

        .form-group label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            color:#333;
        }

        .form-control{
            width:100%;
            padding:10px 12px;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:14px;
        }

        textarea.form-control{
            min-height:100px;
            resize:vertical;
        }

        .grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:15px;
        }

        .btn{
            display:inline-block;
            padding:10px 18px;
            border:none;
            border-radius:5px;
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
        }

        .btn-primary{
            background:#007bff;
            color:white;
        }

        .btn-primary:hover{
            background:#0069d9;
        }

        .btn-danger{
            background:#dc3545;
            color:white;
        }

        .btn-danger:hover{
            background:#c82333;
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
            vertical-align:top;
        }

        table th{
            background:#f1f1f1;
        }

        .badge{
            display:inline-block;
            padding:5px 10px;
            border-radius:4px;
            font-size:13px;
            font-weight:bold;
        }

        .badge-blue{
            background:#dbeafe;
            color:#1d4ed8;
        }

        .badge-green{
            background:#d1fae5;
            color:#065f46;
        }

        .opsi-mini{
            margin-top:8px;
            line-height:1.7;
            color:#444;
            font-size:14px;
        }

        @media(max-width:768px){
            .sidebar{
                width:200px;
            }

            .main-content{
                margin-left:200px;
                padding:20px;
            }

            .grid{
                grid-template-columns:1fr;
            }

            table th, table td{
                font-size:13px;
                padding:10px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_soal.php" class="active">Kelola Soal</a>
        <a href="data_maba.php">Data Maba</a>
        <a href="hasil_ujian.php">Hasil Ujian</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Kelola Soal</h1>

        <?= $pesan ?>

        <div class="card">
            <h2>Tambah Soal Baru</h2>

            <form method="post">
                <div class="form-group">
                    <label>Pertanyaan</label>
                    <textarea name="p" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Fakultas</label>
                    <select name="fakultas" class="form-control" required>
                        <option value="">Pilih Fakultas</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Informatika">Informatika</option>
                    </select>
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label>Pilihan A</label>
                        <input type="text" name="a" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Pilihan B</label>
                        <input type="text" name="b" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Pilihan C</label>
                        <input type="text" name="c" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Pilihan D</label>
                        <input type="text" name="d" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Jawaban Benar</label>
                    <select name="j" class="form-control" required>
                        <option value="">Pilih Jawaban</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <button type="submit" name="simpan" class="btn btn-primary">Simpan Soal</button>
            </form>
        </div>

        <div class="card">
            <h2>Daftar Soal</h2>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan & Opsi</th>
                            <th>Jawaban</th>
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
                            <td>
                                <span class="badge badge-blue"><?= htmlspecialchars($r['fakultas']) ?></span><br><br>
                                <strong><?= htmlspecialchars($r['pertanyaan']) ?></strong>
                                <div class="opsi-mini">
                                    A. <?= htmlspecialchars($r['a']) ?><br>
                                    B. <?= htmlspecialchars($r['b']) ?><br>
                                    C. <?= htmlspecialchars($r['c']) ?><br>
                                    D. <?= htmlspecialchars($r['d']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-green"><?= htmlspecialchars($r['jawaban']) ?></span>
                            </td>
                            <td>
                                <a href="?hapus=<?= $r['id'] ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus soal ini?')">
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