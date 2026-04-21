<?php 
include '../config.php';

$success = "";
$error = "";

if(isset($_POST['regis'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $fakultas = mysqli_real_escape_string($conn, $_POST['fakultas']);
    $tgl = mysqli_real_escape_string($conn, $_POST['tgl']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $no = rand(10000,99999);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Email sudah terdaftar!";
    } else {
        $simpan = mysqli_query($conn,"INSERT INTO users(nama,email,fakultas,tgl_lahir,no_ujian,password) VALUES
        ('$nama','$email','$fakultas','$tgl','$no','$password')");

        if($simpan){
            $success = "Registrasi berhasil. No Ujian Anda: <strong>$no</strong>";
        } else {
            $error = "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .card{
            width:100%;
            max-width:420px;
            background:white;
            padding:30px;
            border-radius:8px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        .card h2{
            text-align:center;
            margin-bottom:10px;
            color:#1f2937;
        }

        .card p{
            text-align:center;
            color:#666;
            margin-bottom:25px;
            font-size:14px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .form-group label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            color:#333;
        }

        .form-control{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:14px;
        }

        .form-control:focus{
            border-color:#007bff;
            outline:none;
        }

        .btn{
            width:100%;
            background:#007bff;
            color:white;
            border:none;
            padding:12px;
            border-radius:5px;
            font-size:15px;
            cursor:pointer;
        }

        .btn:hover{
            background:#0069d9;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:5px;
            margin-bottom:20px;
            font-size:14px;
        }

        .error{
            background:#f8d7da;
            color:#721c24;
            padding:12px;
            border-radius:5px;
            margin-bottom:20px;
            font-size:14px;
        }

        .login-link{
            margin-top:18px;
            text-align:center;
            font-size:14px;
        }

        .login-link a{
            color:#007bff;
            text-decoration:none;
        }

        .login-link a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Register Mahasiswa</h2>
        <p>Silakan isi data untuk membuat akun</p>

        <?php if(!empty($success)){ ?>
            <div class="success"><?= $success ?></div>
        <?php } ?>

        <?php if(!empty($error)){ ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <form method="post">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label>Fakultas</label>
                <select name="fakultas" class="form-control" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Sipil">Teknik Sipil</option>
                    <option value="Informatika">Informatika</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="regis" class="btn">Register</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>

</body>
</html>