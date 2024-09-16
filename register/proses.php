<?php
    include '../koneksi.php';
    print_r($_POST); 
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $leveluser = $_POST['leveluser'];
    $idkaryawan = $_POST['idkaryawan'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_login
    VALUES ('$username', '$password', '$leveluser', '$idkaryawan')");

    if($query) {
        header('location: ../index.php?pesan=berhasil_register');
    }else{
        header('location: index.php?pesan=gagal_register');
    }
?>