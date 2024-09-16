<?php
        @include '../template/cookies.php';
        @include '../template/antibypass.php';
    ?>
    <title>Outlet</title>
    <h1 align="center">OUTLET</h1>
    <?=
    $addbtn
    ?>
    <br>
	<div class="containtable">
    <table class="datatable" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telp</th>
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
            $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id FROM tb_outlet");
            while($baris = mysqli_fetch_assoc($query)) {
                // Memeriksa apakah idoutlet ditemukan pada tb_user
                $query_user = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_user WHERE id_outlet = '".$baris['id']."'");
                $query_transaksi = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_transaksi WHERE id_outlet = '".$baris['id']."'");
                $query_paket = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_paket WHERE id_outlet = '".$baris['id']."'");

                $result_user = mysqli_fetch_assoc($query_user);
                $result_transaksi = mysqli_fetch_assoc($query_transaksi);
                $result_paket = mysqli_fetch_assoc($query_paket);

                if($result_user['total'] > 0 && $_SESSION['role']=='admin') {
                    $delete_button = "";
                    $edit_button = "<td align='center' colspan='2' id='edit'><a href='dashboard.php?page=editoutlet&idoutlet=".$baris['id']."'>$editbtn</a></td>";
                } else if ($result_transaksi['total'] > 0 && $_SESSION['role']=='admin') {
                    $delete_button = "";
                    $edit_button = "<td align='center' colspan='2' id='edit'><a href='dashboard.php?page=editoutlet&idoutlet=".$baris['id']."'>$editbtn</a></td>";
                } else if($result_paket['total'] > 0 && $_SESSION['role']=='admin') {
                    $delete_button = "";
                    $edit_button = "<td align='center' colspan='2' id='edit'><a href='dashboard.php?page=editoutlet&idoutlet=".$baris['id']."'>$editbtn</a></td>";
                } else if ($_SESSION['role']=='admin') {
                    $delete_button = "<td id='delete'><a href='./outlet/delete.php?idoutlet=".$baris['id']."'>$delbtn</a></td>";
                    $edit_button = "<td id='edit'><a href='dashboard.php?page=editoutlet&idoutlet=".$baris['id']."'>$editbtn</a></td>";
                }
            ?>
            <tr>
				<td><?= $no++; ?></td>
                <td><?= @$baris['nama']; ?></td>
                <td><?= @$baris['alamat']; ?></td>
                <td><?= @$baris['tlp']; ?></td>
                <?= @$delete_button; ?>
                <?= @$edit_button; ?>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
	</div>