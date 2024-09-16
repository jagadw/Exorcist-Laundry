<?php
include "koneksi.php";
session_start();

$user = $_POST['username'];
$pass = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$user'");
$baris_role = mysqli_fetch_assoc($query);
$querydatakasir = mysqli_query($koneksi, "SELECT *, tb_user.id AS uid FROM tb_user INNER JOIN tb_outlet ON  tb_user.id_outlet = tb_outlet.id WHERE username='$user'");
$datakasir = mysqli_fetch_assoc($querydatakasir);

$role = $baris_role['role'];
$uid = $datakasir['uid'];
$oid = $datakasir['id'];
$hash = $baris_role['password'];
$cek = mysqli_num_rows($query);
// echo $cek = mysqli_num_rows($query);

if(password_verify($pass, $hash) &&  $cek > 0) {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $role;
        $_SESSION['id_user'] = $uid;
        $_SESSION['id_outlet'] = $oid;

        // if($role=='kasir'){
        //     echo "<script>alert('Berhasil Login');window.location.href='transaksi.php'</script>";
        // } else {
        echo "<script>alert('Berhasil Login');window.location.href='dashboard.php?page=main'</script>";
        // }
    } else {
        echo "<script>alert('Gagal Login');window.location.href='index.php'</script>";
    }
?>