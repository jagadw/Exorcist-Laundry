<?php
include "../koneksi.php";
$id = $_GET['id'];
if (isset($_GET['id'])) {
$edit = mysqli_query($koneksi, "DELETE FROM tb_detail_transaksi WHERE id='$id'");

    if($edit) {
        echo "<script>window.location.href='../dashboard.php?page=detail&pesan=berhasil'</script>";
    } else {
        echo "<script>window.location.href='../dashboard.php?page=detail&pesan=gagal'</script>";
    }
}
?>