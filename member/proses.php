<?php
    include '../koneksi.php';
    // print_r($_POST); 
    $namamember = $_POST['namamember'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $telp = $_POST['telp'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_member
    VALUES (NULL, '$namamember', '$alamat','$jeniskelamin', '$telp')");

    if($query) {
        header('location: ../dashboard.php?page=member&pesan=berhasil_ditambahkan');
    } else {
        header('location: ../dashboard.php?page=member&pesan=gagal_ditambahkan');
    }
?>