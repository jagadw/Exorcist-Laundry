<?php
    include '../koneksi.php';
    // $idtransaksi = $_POST['idtransaksi'];
    $idpelanggan = $_POST['idpelanggan'];
    $idkaryawan = $_POST['idkaryawan'];
    $tgltransaksi = $_POST['tgltransaksi'];
    $kategoripelanggan = $_POST['kategoripelanggan'];
    $totalbayar = $_POST['totalbayar'];
    $bayar = $_POST['bayar'];
    $kembali = $_POST['kembali'];

    $query = "INSERT INTO tb_transaksi VALUES (NULL,'$idpelanggan','$idkaryawan','$tgltransaksi', '$kategoripelanggan','$totalbayar','$bayar','$kembali')";

    echo $query;

    $push = mysqli_query($koneksi, $query);

    var_dump($query);
    if($push) {
        header('location: ../dashboard.php?page=transaksi&pesan=berhasil_ditambahkan');
    } else {
        header('location: ../dashboard.php?page=transaksi&pesan=gagal_ditambahkan');
    }
?>