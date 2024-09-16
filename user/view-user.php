<?php
        @include '../template/cookies.php';
        @include '../template/antibypass.php';
    ?>
    <title>User</title>
	<h1 align="center">USER</h1>
    <br>
	<div class="containtable">
    <table class="datatable" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Outlet</th>
                <?php
                if ($_SESSION['role']=='admin') {
                    echo "<th colspan='2' class='tidak_print'>Aksi</th>";
                } else {
                    echo "";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT *, tb_user.id AS uid FROM tb_user INNER JOIN tb_outlet ON  tb_user.id_outlet = tb_outlet.id ORDER BY tb_user.id ASC ");
            while($baris = mysqli_fetch_assoc($query)) {
            $query_user = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_transaksi WHERE id_user = '".$baris['uid']."'");
            $user_result = mysqli_fetch_assoc($query_user);
                if ($user_result['total'] == 0 && $_SESSION['role']=='admin') {
                    $delete_button = "<td id='delete'><a href='./user/delete.php?id=".$baris['uid']."'>$delbtn</a></td>";
                    $edit_button = "<td id='edit'><a href='dashboard.php?page=edituser&id=".$baris['uid']."'>$editbtn</a></td>";
                } if ($user_result['total'] > 0 && $_SESSION['role']=='admin') {
                    $edit_button = "<td id='edit' colspan='2'><a href='dashboard.php?page=edituser&id=".$baris['uid']."'>$editbtn</a></td>";
                    $delete_button = "";
                }
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= @$baris['name']; ?></td>
                <td><?= @$baris['username']; ?></td>
                <td><?= @$baris['role']; ?></td>
                <td><?= @$baris['nama']; ?></td>
                <?= @$delete_button; ?>
                <?= @$edit_button; ?>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
	</div>