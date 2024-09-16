    <?php
        // @include '../template/cookies.php';
    ?>
    <title>Edit User</title>
    <?php
        if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS oid FROM tb_user INNER JOIN tb_outlet ON  tb_user.id_outlet = tb_outlet.id WHERE tb_user.id='$id'");
        $baris = mysqli_fetch_assoc($query);  
		// var_dump($baris);
    ?>
    <h1 align="center">EDIT USER</h1>
    <form action="dashboard.php?page=edituser" method="post">
        <table class="formtable" align="center">
            <tr>
                <!-- <td>ID</td> -->
                <td><input type="hidden" name="id" value="<?= $id;?>"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?=$baris['name'];?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?=$baris['username'];?>"></td>
            </tr>
			<tr>
                <td>Outlet</td>
				<td><select name="outlet" id="">
                <?php
                $query_outlet = "SELECT * FROM tb_outlet";
                $data_outlet = mysqli_query($koneksi, $query_outlet);
                while ($barisoutlet = mysqli_fetch_assoc($data_outlet)) {
                    ?>
                    <option value="<?=$barisoutlet['id']?>"<?php if($barisoutlet['id']==$baris['id_outlet']){echo "selected";}?>><?=$barisoutlet['nama']?></option>
                <?php
                }
                ?>
                </select></td>
            </tr>            
            <tr>
                <td>Role</td>
                <td><select name="role" value="" id="">
					<?php
					$rolebaris = $baris['role'];
					?>
					<option value="owner" <?php if($rolebaris=='owner'){echo "selected";}?>>Owner</option>
					<option value="admin" <?php if($rolebaris=='admin'){echo "selected";}?>>Admin</option>
                    <option value="kasir" <?php if($rolebaris=='kasir'){echo "selected";}?>>Kasir</option>
					<?php
					}
				?>
            </select></td>
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
    

    if(isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $outlet = $_POST['outlet'];
        $role = $_POST['role'];
        $edit = mysqli_query($koneksi, "UPDATE tb_user SET name='$name', username='$username',  id_outlet='$outlet', role='$role' WHERE id='$id'");

        // echo $edit = "UPDATE tb_user SET name='$name', username='$username', id_outlet='$outlet', role='$role' WHERE id='$id'";

        if ($edit) {
            header('location: dashboard.php?page=user&pesan=edit_berhasil');
        } else {
            header('location: dashboard.php?page=user&pesan=edit_gagal');
        }    
    }
    ?>
<!-- </body>
</html> -->
