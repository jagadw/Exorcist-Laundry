<?php
    include '../koneksi.php';
    if(isset($_GET['idoutlet'])) {
        $idoutlet = $_GET['id'];
        // show form edit dengan data yang sudah diambil dari db
        $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet WHERE id='$idoutlet'");
        $baris = mysqli_fetch_array($query);
        ?>
        <?php
    } else {
        echo "ID outlet tidak ditemukan";
    }
    ?>

<?php
    if(isset($_GET['idoutlet'])) {
        $idoutlet = $_GET['idoutlet'];
        // $perusahaan = $_POST['perusahaan'];
        // $namaoutlet = $_POST['namaoutlet'];
        // $kategorioutlet = $_POST['kategorioutlet'];
        // $hargajual = $_POST['hargajual'];
        // $hargabeli = $_POST['hargabeli'];
        // $stok_outlet = $_POST['stok_outlet'];
        // $keterangan = $_POST['keterangan'];

        $delete = mysqli_query($koneksi, "DELETE FROM tb_outlet WHERE id='$idoutlet'");

        if($delete) {
            header('location: ../dashboard.php?page=outlet&pesan=berhasil_diubah');
        } else {
            header('location: ../dashboard.php?page=outlet&pesan=gagal_diubah');
        }
        // var_dump($delete);
    }
?>