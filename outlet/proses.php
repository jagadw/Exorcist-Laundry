<?php
    include '../koneksi.php';
    // print_r($_POST);
    $perusahaan = $_POST['perusahaan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_outlet
    VALUES (NULL, '$nama', '$alamat','$telp')");

    if($query) {
        header('location: ../dashboard.php?page=outlet&pesan=berhasil_ditambahkan');
    } else {
        header('location: ../dashboard.php?page=outlet&pesan=gagal_ditambahkan');
    }
?>