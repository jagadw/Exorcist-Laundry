<?php
    include '../koneksi.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // show form edit dengan data yang sudah diambil dari db
        $query = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id=$id");
        $baris = mysqli_fetch_array($query);
        ?>
        <?php
    } else {
        echo "ID member tidak ditemukan";
    }
    ?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $delete = mysqli_query($koneksi, "DELETE FROM tb_member WHERE id='$id'");

        if($delete) {
            header('location: ../dashboard.php?page=member&pesan=berhasil_diubah');
        } else {
            header('location: ../dashboard.php?page=member&pesan=gagal_diubah');
        }
        // var_dump($delete);
    }
?>