<?php
include '../config.php'; 

$error = "";

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $q = mysqli_query($conn,"SELECT * FROM users 
        WHERE email='$email' AND password='$password'");

    if(mysqli_num_rows($q) > 0){
        $_SESSION['user'] = mysqli_fetch_assoc($q);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau Password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta</title>
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
            max-width:400px;
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

        .register{
            margin-top:15px;
            text-align:center;
            font-size:14px;
        }

        .register a{
            color:#007bff;
            text-decoration:none;
        }

        .register a:hover{
            text-decoration:underline;
        }

        .error{
            background:#f8d7da;
            color:#721c24;
            padding:12px;
            border-radius:5px;
            margin-bottom:20px;
            font-size:14px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Login Peserta</h2>
        <p>Silakan masuk untuk mengikuti ujian</p>

        <?php if(!empty($error)){ ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login" class="btn">Login</button>

            <div class="register">
                Belum punya akun? <a href="register.php">Daftar di sini</a>
            </div>
        </form>
    </div>

</body>
</html>