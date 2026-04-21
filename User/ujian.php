<?php
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$query_user = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query_user);

// Cek apakah sudah ujian
if($user['sudah_ujian'] == 1) {
    echo "<script>alert('Anda sudah mengerjakan ujian!'); window.location='hasil.php';</script>";
    exit();
}

// Proses submit jawaban
if(isset($_POST['submit'])) {
    $jawaban_user = isset($_POST['jawaban']) ? $_POST['jawaban'] : array();
    $total_benar = 0;
    
    // Ambil semua soal dari database
    $query_soal = mysqli_query($conn, "SELECT * FROM soal");
    $jumlah_soal = mysqli_num_rows($query_soal);
    
    if($jumlah_soal > 0) {
        while($soal = mysqli_fetch_assoc($query_soal)) {
            $id_soal = $soal['id'];
            $jawaban_benar = $soal['jawaban_benar'];
            
            // Cek apakah soal dijawab dan jawabannya benar
            if(isset($jawaban_user[$id_soal]) && $jawaban_user[$id_soal] == $jawaban_benar) {
                $total_benar++;
            }
        }
        
        // Hitung nilai (skala 0-100)
        $nilai = round(($total_benar / $jumlah_soal) * 100);
        $status = ($nilai >= 60) ? "LULUS" : "TIDAK LULUS";
        
        // Simpan ke tabel hasil_ujian
        $nama = $user['nama'];
        $query_simpan = "INSERT INTO hasil_ujian (user_id, nama, nilai, status) VALUES ('$user_id', '$nama', '$nilai', '$status')";
        
        if(mysqli_query($conn, $query_simpan)) {
            // Update status sudah ujian
            mysqli_query($conn, "UPDATE users SET sudah_ujian=1 WHERE id='$user_id'");
            echo "<script>alert('Ujian selesai! Jawaban benar: $total_benar dari $jumlah_soal soal\\nNilai Anda: $nilai\\nStatus: $status'); window.location='hasil.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan hasil ujian!');</script>";
        }
    } else {
        echo "<script>alert('Belum ada soal! Silahkan hubungi admin.');</script>";
    }
    exit();
}

// Ambil semua soal untuk ditampilkan
$query_soal = mysqli_query($conn, "SELECT * FROM soal");
$jumlah_soal = mysqli_num_rows($query_soal);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ujian MABA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .soal-box {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fafafa;
        }
        .soal-box p {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .option {
            margin: 5px 0 5px 20px;
        }
        .option label {
            margin-left: 5px;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        .info {
            background: #e7f3ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Ujian Mahasiswa Baru</h2>
        <div class="info">
            <strong>Nama:</strong> <?= htmlspecialchars($user['nama']) ?><br>
            <strong>No. Ujian:</strong> <?= htmlspecialchars($user['no_ujian']) ?><br>
            <strong>Jumlah Soal:</strong> <?= $jumlah_soal ?>
        </div>

        <?php if($jumlah_soal == 0) { ?>
            <p style="color: red;">⚠️ Belum ada soal ujian. Silahkan hubungi admin!</p>
        <?php } else { ?>
            <form method="POST" onsubmit="return confirm('Yakin ingin menyelesaikan ujian?')">
                <?php 
                $no = 1;
                while($soal = mysqli_fetch_assoc($query_soal)) { 
                ?>
                <div class="soal-box">
                    <p><?= $no++ ?>. <?= htmlspecialchars($soal['pertanyaan']) ?></p>
                    <div class="option">
                        <input type="radio" name="jawaban[<?= $soal['id'] ?>]" value="A" id="q<?= $soal['id'] ?>_a" required>
                        <label for="q<?= $soal['id'] ?>_a">A. <?= htmlspecialchars($soal['a']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="jawaban[<?= $soal['id'] ?>]" value="B" id="q<?= $soal['id'] ?>_b">
                        <label for="q<?= $soal['id'] ?>_b">B. <?= htmlspecialchars($soal['b']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="jawaban[<?= $soal['id'] ?>]" value="C" id="q<?= $soal['id'] ?>_c">
                        <label for="q<?= $soal['id'] ?>_c">C. <?= htmlspecialchars($soal['c']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="jawaban[<?= $soal['id'] ?>]" value="D" id="q<?= $soal['id'] ?>_d">
                        <label for="q<?= $soal['id'] ?>_d">D. <?= htmlspecialchars($soal['d']) ?></label>
                    </div>
                </div>
                <?php } ?>
                <button type="submit" name="submit">✅ Selesai Ujian</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>