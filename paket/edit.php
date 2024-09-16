<?php
@include '../template/cookies.php';
?>
    <title>Edit Paket</title>
    <?php
    if(isset($_GET['id'])) {
        $idpaket = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT *, tb_paket.id AS pid,tb_outlet.id AS oid FROM tb_paket INNER JOIN tb_outlet WHERE tb_paket.id=$idpaket");
        $baris = mysqli_fetch_assoc($query);
		// var_dump($baris);
        ?>
        <h1 align="center">EDIT PAKET</h1>
        <form action="dashboard.php?page=editpaket" method="post">
        <table class="formtable" align="center">
            <tr>
                <td><input type="hidden" name="id" value="<?=$idpaket?>"></td>
            </tr>
            <tr>
            <td>Outlet</td>
            <td><select name="id_outlet" value="" id="">
					<?php
					// $idoutlet = $baris['oid'];
                    // $queryoutlet = mysqli_query($koneksi, "SELECT id FROM tb_outlet WHERE id=$idoutlet");
                    // $outlet = mysqli_fetch_assoc($queryoutlet);
                    $query2 = "SELECT * FROM tb_outlet";
                    $outlet2 = mysqli_query($koneksi, $query2);
                    while($barisoutlet = mysqli_fetch_assoc($outlet2)){                    
					?>
					<option value="<?=$barisoutlet['id']?>"<?php if($barisoutlet['id']==$baris['id_outlet']){echo "selected";}?>><?=$barisoutlet['nama']?></option>
                    <?php
                    }
                    ?>
                </select>
			</td>
			</tr>
            <tr>
                <td>Jenis</td>
                <td><select name="jenis" value="" id="">
					<?php
					$jenis = $baris['jenis'];
					?>
					<option value="kiloan"<?php if($jenis=='kiloan'){echo "selected";}?>>kiloan</option>
                    <option value="selimut"<?php if($jenis=='selimut'){echo "selected";}?>>selimut</option>
					<option value="bed_cover"<?php if($jenis=='bed_cover'){echo "selected";}?>>bed cover</option>
					<option value="kaos"<?php if($jenis=='kaos'){echo "selected";}?>>kaos</option>
					<option value="lain"<?php if($jenis=='lain'){echo "selected";}?>>lain-lain</option>
                </select>
        </td>
            </tr>
            <tr>
                <td>Nama Paket</td>
                <td><input type="text" name="nama_paket" value="<?= $baris['nama_paket']?>"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="harga" value="<?= $baris['harga']?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Simpan" name="edit" id="submit"></td>
            </tr>
            <tr>
                <td colspan="3"><hr></td>
            </tr>
        </table>
        </form>
        <?php
    }

    if(isset($_POST['edit'])) {
        $idpaket = $_POST['id'];
        $id_outlet = $_POST['id_outlet'];
        $jenis = $_POST['jenis'];
        $nama_paket = $_POST['nama_paket'];
        $harga = $_POST['harga'];

        $edit = mysqli_query($koneksi, "UPDATE tb_paket SET id_outlet='$id_outlet', jenis='$jenis', nama_paket='$nama_paket', harga='$harga' WHERE tb_paket.id='$idpaket'");
		if ($edit) {
		header('location: dashboard.php?page=paket&pesan=edit_berhasil');
		} else {
		header('location: dashboard.php?page=paket&pesan=edit_gagal');
		}      
        // var_dump($_POST);       
    }
    ?>
<!-- </body>
</html> -->