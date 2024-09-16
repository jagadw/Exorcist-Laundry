<?php
include "../koneksi.php";
$id = $_GET['id'];
if (isset($_GET['id'])) {
$status = $_GET['status'];
$edit = mysqli_query($koneksi, "UPDATE tb_transaksi SET status='$status' WHERE id='$id'");

    if($edit) {
        echo "<script>window.location.href='../dashboard.php?page=detail&id_transaksi=$id&pesan=berhasil'</script>";
    } else {
        echo "<script>window.location.href='../dashboard.php?page=detail&id_transaksi=$id&pesan=gagal'</script>";
    }
}
?>