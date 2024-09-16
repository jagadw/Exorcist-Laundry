<?php
        @include '../template/cookies.php';
    ?>
    <title>Edit Outlet</title>
    <?php
        if(isset($_GET['idoutlet'])) {
        $idoutlet = $_GET['idoutlet'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet WHERE id='$idoutlet'");
        $baris = mysqli_fetch_assoc($query);  
// var_dump($baris);		
    ?>
    <h1 align="center">EDIT OUTLET</h1>
    <form action="dashboard.php?page=editoutlet" method="post">
        <table class="formtable" align="center">
            <tr>
                <!-- <td>ID Supplier</td> -->
                <td><input type="hidden" name="idoutlet" value="<?= $baris['id'];?>"></td>
            </tr>
            <tr>
                <td>Nama Outlet</td>
                <td><input type="text" name="nama" value="<?= $baris['nama'];?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?= $baris['alamat'];?>"></td>
            </tr>
			<tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?= $baris['tlp'];?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Simpan" name="edit" id="submit"></td>
            </tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
        </table>
    </form>
    <?php
    }

    if(isset($_POST['edit'])) {
        $idoutlet = $_POST['idoutlet'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
    
        $edit = mysqli_query($koneksi, "UPDATE tb_outlet SET nama='$nama', alamat='$alamat', tlp='$telp' WHERE id='$idoutlet'");
    
        if ($edit) {
            header('location: dashboard.php?page=outlet&pesan=edit_berhasil');
        } else {
            header('location: dashboard.php?page=outlet&pesan=edit_gagal');
        }    
    }
    ?>
<!-- </body>
</html> -->