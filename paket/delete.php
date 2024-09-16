<?php
    include '../koneksi.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // show form edit dengan data yang sudah diambil dari db
        $query = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE id=$id");
        $baris = mysqli_fetch_array($query);
        ?>
        <?php
    } else {
        echo "Paket tidak ditemukan!";
    }
    ?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // $perusahaan = $_POST['perusahaan'];
        // $namaobat = $_POST['namaobat'];
        // $kategoriobat = $_POST['kategoriobat'];
        // $hargajual = $_POST['hargajual'];
        // $hargabeli = $_POST['hargabeli'];
        // $stok_obat = $_POST['stok_obat'];
        // $keterangan = $_POST['keterangan'];

        $delete = mysqli_query($koneksi, "DELETE FROM tb_paket WHERE id='$id'");

        if($delete) {
            header('location: ../dashboard.php?page=paket&pesan=berhasil_diubah');
        } else {
            header('location: ../dashboard.php?page=paket&pesan=gagal_diubah');
        }
    }
?>