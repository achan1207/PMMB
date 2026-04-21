<?php 
include '../config.php'; 

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$u = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            display:flex;
            min-height:100vh;
            background:#f4f6f9;
        }
        /* MAIN */
        .main{
            flex:1;
            display:flex;
            flex-direction:column;
        }

        .topbar{
            background:#fff;
            padding:20px 30px;
            border-bottom:1px solid #ddd;
        }

        .topbar h1{
            font-size:26px;
            color:#222;
        }

        .content{
            padding:30px;
        }

        /* CARD PROFIL */
        .profile-card{
            background:#fff;
            border-radius:15px;
            padding:30px;
            box-shadow:0 2px 8px rgba(0,0,0,0.05);
            display:flex;
            gap:30px;
            align-items:center;
            flex-wrap:wrap;
        }

        .profile-photo{
            width:150px;
            height:150px;
            border-radius:50%;
            overflow:hidden;
            border:3px solid #ddd;
            cursor:pointer;
            flex-shrink:0;
            transition:0.3s;
        }

        .profile-photo:hover{
            transform:scale(1.03);
        }

        .profile-photo img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .profile-info{
            flex:1;
            min-width:280px;
        }

        .profile-info h2{
            font-size:32px;
            margin-bottom:20px;
            color:#222;
        }

        .info-item{
            margin-bottom:15px;
            font-size:18px;
            color:#444;
        }

        .info-item strong{
            display:inline-block;
            width:120px;
            color:#111;
        }

        .fakultas{
            margin-top:15px;
            font-size:20px;
            font-weight:600;
            color:#222;
        }

        .btn-area{
            margin-top:25px;
            display:flex;
            gap:15px;
            flex-wrap:wrap;
        }

        .btn{
            text-decoration:none;
            background:#0d6efd;
            color:white;
            padding:12px 20px;
            border-radius:8px;
            font-size:15px;
            transition:0.3s;
        }

        .btn:hover{
            background:#0b5ed7;
        }

        .btn.logout{
            background:#dc3545;
        }

        .btn.logout:hover{
            background:#bb2d3b;
        }

        /* MODAL FOTO */
        .modal{
            display:none;
            position:fixed;
            z-index:999;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.8);
            justify-content:center;
            align-items:center;
        }

        .modal img{
            max-width:90%;
            max-height:85%;
            border-radius:20px;
        }

        .close{
            position:absolute;
            top:30px;
            right:40px;
            color:white;
            font-size:40px;
            font-weight:bold;
            cursor:pointer;
        }

        /* RESPONSIVE */
        @media (max-width:768px){
            body{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
                border-right:none;
                border-bottom:1px solid #ddd;
            }

            .menu{
                flex-direction:row;
                flex-wrap:wrap;
            }

            .menu a{
                flex:1 1 45%;
                text-align:center;
            }

            .profile-card{
                flex-direction:column;
                text-align:center;
            }

            .info-item strong{
                width:100%;
                display:block;
                margin-bottom:5px;
            }

            .btn-area{
                justify-content:center;
            }
        }
    </style>
</head>
<body>
    <!-- MAIN -->
    <div class="main">
        <div class="topbar">
            <h1>Profil Mahasiswa</h1>
        </div>

        <div class="content">
            <div class="profile-card">
                
                <!-- FOTO -->
                <div class="profile-photo" onclick="openModal()">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Foto Profil">
                </div>

                <!-- DATA -->
                <div class="profile-info">
                    <h2>No Ujian: <?= htmlspecialchars($u['no_ujian']) ?></h2>

                    <div class="info-item">
                        <strong>Nama</strong> : <?= htmlspecialchars($u['nama']) ?>
                    </div>

                    <div class="info-item">
                        <strong>Email</strong> : <?= htmlspecialchars($u['email']) ?>
                    </div>

                    <div class="info-item">
                        <strong>Fakultas</strong> : <?= htmlspecialchars($u['fakultas']) ?>
                    </div>

                    <div class="btn-area">
                        <a href="dashboard.php" class="btn">Kembali</a>
                        <a href="logout.php" class="btn logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOTO -->
    <div class="modal" id="photoModal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Foto Besar">
    </div>

    <script>
        function openModal() {
            document.getElementById("photoModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("photoModal").style.display = "none";
        }
    </script>

</body>
</html>