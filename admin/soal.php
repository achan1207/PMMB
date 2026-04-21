<?php 
include '../config.php';

if(isset($_POST['simpan'])){
    $p = mysqli_real_escape_string($conn, $_POST['p']);
    $a = mysqli_real_escape_string($conn, $_POST['a']);
    $b = mysqli_real_escape_string($conn, $_POST['b']);
    $c = mysqli_real_escape_string($conn, $_POST['c']);
    $d = mysqli_real_escape_string($conn, $_POST['d']);
    $j = mysqli_real_escape_string($conn, $_POST['j']);

    mysqli_query($conn, "INSERT INTO soal (pertanyaan,a,b,c,d,jawaban) VALUES ('$p','$a','$b','$c','$d','$j')");
    header("Location: ".$_SERVER['PHP_SELF']."?success=1");
    exit;
}

if(isset($_GET['hapus'])){
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM soal WHERE id=$id");
    header("Location: ".$_SERVER['PHP_SELF']."?hapus_sukses=1");
    exit;
}

$q = mysqli_query($conn, "SELECT * FROM soal ORDER BY id DESC");
?>