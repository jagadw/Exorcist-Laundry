<?php
    include '../koneksi.php';
    // $idobat = $_POST['idobat'];
    $id_outlet = $_POST['id_outlet'];
    $jenis = $_POST['jenis'];
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_paket (id, id_outlet, jenis, nama_paket, harga)
    VALUES (NULL, '$id_outlet', '$jenis', '$nama_paket', '$harga')");

    if($query) {
        header('location: ../dashboard.php?page=paket&pesan=berhasil_ditambahkan');
    }else{
        header('location: ../dashboard.php?page=paket&pesan=gagal_ditambahkan');
    }
?>