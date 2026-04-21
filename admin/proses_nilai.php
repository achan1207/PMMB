<?php
include '../config.php';

$user_id = $_POST['user_id'];
$nama    = $_POST['nama'];
$nilai   = $_POST['nilai'];

// aturan kelulusan
if($nilai >= 75){
    $status = "LULUS (Diterima)";
} else {
    $status = "TIDAK LULUS";
}

$conn->query("INSERT INTO hasil_ujian(user_id,nama,nilai,status) 
VALUES('$user_id','$nama','$nilai','$status')");

header("Location: hasil_ujian.php");