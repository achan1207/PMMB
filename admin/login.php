<?php 
include '../config.php';

$pesan = "";

if(isset($_POST['login'])){
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = mysqli_real_escape_string($conn, $_POST['password']);

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' AND password='$p'");

    if(mysqli_num_rows($q) > 0){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "<div class='alert danger'>Username atau password salah!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:white;
            width:100%;
            max-width:400px;
            padding:30px;
            border-radius:8px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        .login-box h2{
            text-align:center;
            margin-bottom:10px;
            color:#1f2937;
        }

        .login-box p{
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

        .alert{
            padding:12px 15px;
            margin-bottom:20px;
            border-radius:5px;
            font-size:14px;
        }

        .danger{
            background:#f8d7da;
            color:#721c24;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login Admin</h2>
        <p>Silakan masuk ke panel admin</p>

        <?= $pesan ?>

        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>

</body>
</html>