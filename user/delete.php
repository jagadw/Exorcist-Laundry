<?php
    include '../koneksi.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // show form edit dengan data yang sudah diambil dari db
        $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
        $baris = mysqli_fetch_array($query);
        ?>
        <?php
    } else {
        // echo "id tidak ditemukan";
		echo "<script>alert('User tidak ditemukan');window.location.href='dashboard.php?page=login'</script>";
    }
    ?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // $perusahaan = $_POST['perusahaan'];
        // $namalogin = $_POST['namalogin'];
        // $kategorilogin = $_POST['kategorilogin'];
        // $hargajual = $_POST['hargajual'];
        // $hargabeli = $_POST['hargabeli'];
        // $stok_login = $_POST['stok_login'];
        // $keterangan = $_POST['keterangan'];

        // Cara ambil sintaks mysql lewat var_dump($delete);
        // mysqli_query($koneksi dihilangin
        // $delete = "DELETE FROM tb_user WHERE id='$id'";

        $delete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id='$id'");

        if($delete) {
            header('location: ../dashboard.php?page=user&pesan=berhasil_diubah');
        } else {
            header('location: ../dashboard.php?page=user&pesan=gagal_diubah');
        }
        // var_dump($delete);
    }
?>