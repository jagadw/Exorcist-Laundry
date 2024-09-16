<?php
        @include '../template/cookies.php';
        @include '../template/antibypass.php';
    ?>
    <title>Paket</title>
    <h1 align="center">PAKET</h1>
    <?php
    // $page = $_GET['page'];
    // $addbtn = "<div class='addbtn'><a href='dashboard.php?page=add$page'>Tambah</a></div>";
    echo $addbtn;
    // var_dump($_SESSION['leveluser']);
    ?>
    <br>
	<div class="containtable">
    <table class="datatable" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Outlet</th>
                <th>Jenis</th>
                <th>Nama Paket</th>
                <th>Harga</th>
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
            $query = mysqli_query($koneksi, "SELECT *, tb_paket.id AS pid, tb_outlet.id AS oid FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id ORDER BY tb_paket.id ASC");
            while($baris = mysqli_fetch_assoc($query)) {
            $id = $baris['pid'];
            $hide_delete = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi WHERE id_paket = '".$baris['pid']."'");
            $cek = mysqli_num_rows($hide_delete);
            ?>
            <tr>
				<td><?= $no++; ?></td>
                <td><?= $baris['nama']; ?></td>
                <td><?= $baris['jenis']; ?></td>
                <td><?= $baris['nama_paket']; ?></td>
                <td><?= $baris['harga']; ?></td>
                <?php
            // var_dump($cek);
            if($cek==0 && $_SESSION['role']=='admin'){
                ?>
                <td id="delete"><a href="./paket/delete.php?id=<?=$id?>"><?=$delbtn?></a></td>
                <td id="edit"><a href="dashboard.php?page=editpaket&id=<?=$id?>"><?=$editbtn?></a></td>
                <?php
            } elseif ($cek>0 && $_SESSION['role']=='admin') {
                ?>
                <td colspan="2" id="edit"><a href="dashboard.php?page=editpaket&id=<?=$id;?>"><?=$editbtn?></a></td>
                <?php
            } else {
                ?>
                <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
	</div>