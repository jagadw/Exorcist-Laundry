    <?php
        @include '../template/cookies.php';
    ?>
    <title>Edit Member</title>
    <?php
        if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id=$id");
        $baris = mysqli_fetch_assoc($query);    
    ?>
    <h1 align="center">EDIT MEMBER</h1>
    <form action="dashboard.php?page=editmember" method="post">
        <table class="formtable" align="center">
            <tr>
                <!-- <td>ID member</td> -->
                <td><input type="hidden" name="id" value="<?= $baris['id'];?>"></td>
            </tr>
            <tr>
                <td>Nama Member</td>
                <td><input type="text" name="namamember" value="<?= $baris['nama'];?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?= $baris['alamat'];?>"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <select name="jeniskelamin" id="">
					<?php
					$kelamin = $baris['jenis_kelamin'];
					?>
					<option value="L" <?php if($kelamin=='L'){echo "selected";}?>>Laki-laki</option>
					<option value="P" <?php if($kelamin=='P'){echo "selected";}?>>Perempuan</option>
                </select>
            </td>
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
        $id = $_POST['id'];
        $namamember = $_POST['namamember'];
        $alamat = $_POST['alamat'];
		$jeniskelamin = $_POST['jeniskelamin'];
        $telp = $_POST['telp'];

        $edit = mysqli_query($koneksi, "UPDATE tb_member SET nama='$namamember', alamat='$alamat', jenis_kelamin='$jeniskelamin', tlp='$telp' WHERE id='$id'");

        if ($edit) {
            header('location: dashboard.php?page=member&pesan=edit_berhasil');
        } else {
            header('location: dashboard.php?page=member&pesan=edit_gagal');
        }    
    }
    ?>
<!-- </body>
</html> -->