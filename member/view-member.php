<?php
        @include '../template/cookies.php';
        @include '../template/antibypass.php';
    ?>
    <title>Member</title>
	<h1 align="center">MEMBER</h1>
    <?php
    if ($_SESSION['role']=="owner") {
            $page = $_GET['page'];
            $addbtn = "";
    }
    else if ($_SESSION['role']=="admin" || $_SESSION['role']=="kasir") {
            $page = $_GET['page'];
            $addbtn = "<div class='addbtn tidak_print'><a href='dashboard.php?page=add$page'><i class='fa-solid fa-circle-plus'></i></a></div>";
    } else {
            $page = $_GET['page'];
            $addbtn = "";
    }

    echo $addbtn;
    ?>
    <br>
	<div class="containtable">
    <table class="datatable" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
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
            $query = mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY id ASC");
            while($baris = mysqli_fetch_assoc($query)) {
                $query_transaksi = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_transaksi WHERE id_member = '".$baris['id']."'");
                // $query_login = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM 
                //  WHERE idmember = '".$baris['idmember']."'");

                $result_transaksi = mysqli_fetch_assoc($query_transaksi);
                // $result_login = mysqli_fetch_assoc($query_login);

                if($result_transaksi['total'] > 0 && $_SESSION['role']=='admin') {
                    $delete_button = "";
                    $edit_button = "<td align='center' colspan='2' id='edit'><a href='dashboard.php?page=editmember&id=".$baris['id']."'>$editbtn</a></td>";
                // } elseif($result_login['total'] > 0) {
                //     $delete_button = "";
                //     $edit_button = "<td align='center' colspan='2' id='edit'><a href='dashboard.php?page=editmember&idmember=".$baris['idmember']."'>Edit</a></td>";
                //
                } elseif ($result_transaksi['total'] == 0 && $_SESSION['role']=='admin') {
                    $delete_button = "<td id='delete'><a href='./member/delete.php?id=".$baris['id']."'>$delbtn</a></td>";
                    $edit_button = "<td id='edit'><a href='dashboard.php?page=editmember&id=".$baris['id']."'>$editbtn</a></td>";
                }
            ?>
            <tr>
				<td><?= $no++; ?></td>
                <td><?= @$baris['nama']; ?></td>
                <td><?= @$baris['alamat']; ?></td>
                <td><?= @$baris['jenis_kelamin']; ?></td>
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