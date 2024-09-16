<?php
if (@$_GET['id_transaksi']) {
    $idtransaksi = $_GET['id_transaksi'];
} else if (@$_SESSION['id_transaksi']) {
    $idtransaksi = $_SESSION['id_transaksi'];
}

$data_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT * FROM tb_transaksi INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tb_transaksi.id='$idtransaksi'"));

if (@$_POST['pilih_paket']) {
    $qty = $_POST['qty'];
    $nama_paket = $_POST['nama_paket'];
    $row_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE nama_paket = '$nama_paket'"));
    $harga_paket = $row_paket['harga'];
    $hargatotal = $qty * $harga_paket;
    $id_paket = $row_paket['id'];
    $keterangan = $_POST['keterangan'];
    mysqli_query($koneksi, "INSERT INTO tb_detail_transaksi VALUES(NULL, '$idtransaksi', '$id_paket', '$qty', '$hargatotal', '$keterangan')");
    echo "<script>window.location.href=window.location.href</script>";
}

if(@$_POST['bayar_sekarang']) {
    //update kolom tgl_bayar ketika klik tombol bayar sekarang
    date_default_timezone_set('Asia/Makassar');
    $tgl_bayar = date("Y-m-d H:i:s");
    mysqli_query($koneksi, "UPDATE tb_transaksi SET tgl_bayar = '$tgl_bayar', dibayar = 'dibayar' WHERE id ='$idtransaksi'");
    //update kolom tgl_bayar ketika klik tombol bayar sekarang
    echo "<script>window.location.href=window.location.href</script>";
}

if ($data_transaksi['11']=='belum_dibayar') {
    $warna = "#ffc300";
    $pembayaran = "<span style='color: $warna; font-size: 28px;'><i class='fa-regular fa-circle-xmark'></i></span>Belum Lunas";
} else {
    $warna = "#32de00";
    $pembayaran = "<span style='color: $warna; font-size: 28px;'><i class='fa-regular fa-circle-check'></i></span>Lunas";
}

if(@$_POST['tombol_biaya_tambahan']) {
    $biaya_tambahan = $_POST['biaya_tambahan'];
    mysqli_query($koneksi, "UPDATE tb_transaksi SET biaya_tambahan='$biaya_tambahan' WHERE id='$idtransaksi'");
    echo "<script>window.location.href=window.location.href</script>";
}

?>
<br>
<center>
    <h3 style="color:white;"><?=$pembayaran?></h3>

    <!-- tabel atas -->
    <table class="whitepaper" cellspacing="0">
    <tbody>
        <tr>
            <td>Kode Invoice</td>
            <td><?=$data_transaksi['2']?></td>
        </tr>
        <!-- <tr>
            <td>Kode Invoice</td>
            <td><?//=$data_transaksi['2']?></td>
        </tr> -->
        <tr>
            <td>Nama Pelanggan</td>
            <td><?=$data_transaksi['14']?></td>
        </tr>
        <tr>
            <td>Telp</td>
            <td><?=$data_transaksi['17']?><a href="https://wa.me/<?=$data_transaksi['17']?>?text=[LAUNDRY EXORCIST]%20Halo kak%20<?=$data_transaksi['14']?>,%20pesanan anda dengan kode invoice%20<?=$data_transaksi['2']?>%20telah%20berstatus%20<?=$data_transaksi['10']?>%20dan dapat di ambil sebelum%20<?=$data_transaksi['5']?>."><i class="fa-solid fa-comment-dots whatsapp"></i></a></td>
        </tr>
        <tr>
            <td>Alamat Pelanggan</td>
            <td><?=$data_transaksi['15']?></td>
        </tr>
        <tr>
            <td>Nama Kasir</td>
            <td><?=$data_transaksi['23']?></td>
        </tr>
        <tr>
            <td>Ambil Sebelum</td>
            <td>
                <?php
                    $data_transaksi['5'];
                    $pecah_string_tanggal = explode(" ", $data_transaksi['5']);
                    $pecah_string_hari = explode("-", $pecah_string_tanggal['0']);
                    $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);

                    echo "Tanggal : ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
                    echo "<br>";
                    echo "Jam : ".$pecah_string_jam['0'].":".$pecah_string_jam['1'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
            <form action="transaksi/edit.php" method="get">
                <input type="hidden" value="<?=$idtransaksi?>" name="id">
                <select onchange="submit()" name="status" id="status">
                <option value="baru" <?php if($data_transaksi['10']=='baru'){echo "selected";}?>>Baru</option>
                <option value="proses" <?php if($data_transaksi['10']=='proses'){echo "selected";}?>>Proses</option>
                <option value="selesai" <?php if($data_transaksi['10']=='selesai'){echo "selected";}?>>Selesai</option>
                <option value="diambil" <?php if($data_transaksi['10']=='diambil'){echo "selected";}?>>Diambil</option>
            </select>
            </form>
            </td>
        </tr>

    </tbody>
</table>
<br><br>
<!-- tabel atas -->





<!-- input paket -->
<div class="transaksi">
<?php 
	if($_SESSION['role']=='admin'||$_SESSION['role']=='kasir'){
	if($data_transaksi['11']=='belum_dibayar') {
?>
    <div class="left-transaksi">
    <form action="dashboard.php?page=detail&id_transaksi=<?=$idtransaksi?>" method="post">
    <b>Tambah Pesanan</b>
    <table>
        <tr>
            <!-- <td><span>Nama Paket</span></td> -->
            <td><input type="text" name="nama_paket" list="nama_paket" autocomplete="off"  placeholder="Pilih Paket" required></td>
            <datalist id="nama_paket">
            <?php
            echo $id_outlet=$data_transaksi['18'];
            $query_paket = mysqli_query($koneksi, "SELECT nama_paket FROM tb_paket WHERE id_outlet='$id_outlet'");
            while($data_paket = mysqli_fetch_assoc($query_paket)) {
            ?>
            <option value="<?=$data_paket['nama_paket']?>"></option>
            <?php
            }
            ?>
        </tr>
        <tr><td> </td></tr>
        <tr>
            <!-- <td><span>Qty</span></td> -->
            <td><input type="number" name="qty" placeholder="Qty" required></td>
        </tr>
        <tr><td> </td></tr>
        <tr>
            <!-- <td><span>Keterangan</span></td> -->
            <td><input type="text" name="keterangan" placeholder="Keterangan" autocomplete="off"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" id="submit" value="Tambahkan" name="pilih_paket"></td>
        </tr>
    </table>
        </datalist>
    </form>
<?php
}
?>
<!-- input paket -->





<!-- biaya tambahan -->
<?php
if($data_transaksi['11']=='belum_dibayar') {
?>
<form action="dashboard.php?page=detail&id_transaksi=<?=$idtransaksi?>" method="post">
    <table>
        <tr>
            <td>
                <input type="number" placeholder="Biaya Tambahan" name="biaya_tambahan">
                <input type="submit" id="submit" value="Tambahkan" name="tombol_biaya_tambahan">
            </td>
        </tr>
    </table>
</form>
<p> </p>
</div>
<?php
}
}
?>
<!-- biaya tambahan -->





<!-- tabel transaksi -->
<br>
<div class="right-transaksi totalharga">
<table border="0" cellspacing="2" style="min-width: 100%;">
    <thead>
        <tr class="bold">
        <td>Nama Paket</td>
        <td align="right">Keterangan</td>
        <td align="center">Qty</td>
        <td>Harga</td>
        <td align="right">Total Harga</td>
    </tr>
    </thead>
    <tbody>
        <?php
            $result_detail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi WHERE id_transaksi='$idtransaksi'");
            while ($detail = mysqli_fetch_assoc($result_detail)) {
            ?>
            <tr>
                <td>
                    <?php
                    $idpaket = $detail['id_paket'];
                    $paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, jenis, harga FROM tb_paket WHERE id='$idpaket'"));
                    echo $paket['nama_paket'];
                    echo "<br>";
                    echo $paket['jenis'];
                    ?>
                </td>
                <td align="right"><?=$detail['keterangan']?></td>
                <td align="center"><?=$detail['qty']?></td>
                <td><?=number_format($paket['harga'], 0, ',', '.')?></td>
                <td align="right" class="bold">
            Rp. <?=number_format($detail['hargatotal'], 0, ',', '.')?></td>
            <?php
            if($data_transaksi['11']=='belum_dibayar') {
            ?>
            <form action="transaksi/delete.php" method="get">
                <input type="hidden" name="id" value="<?=$detail['id']?>">
				<?php
					if($_SESSION['role']=='admin'||$_SESSION['role']=='kasir'){
				?>
                <td><button type="submit" id="x"> x </button>
				<?php
					}
				?>
            </td>
            </form>
            <?php
            }
            ?>
            </tr>
            <?php
            }
        ?>
        <?php
        $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(hargatotal) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$idtransaksi'"));
        if (!$grand_total['0']=='0') {
        ?>
        <tr>
        <td align="right" class="bold" colspan="4">Pajak</td>
        <td align="right" class="bold">
    <?php
        echo "0,75%";
        echo "<br>";
        $pajak = $grand_total['0'] * $data_transaksi['9'];
        echo "Rp. ". number_format($pajak, 0, ',', '.');
    ?></td></tr>
        <?php
        if ($data_transaksi['7']!='0') {
        ?>
        <tr>
            <td colspan="4" class="bold" align="right">Biaya Tambahan</td>
            <td align="right" class="bold">
        <?= "Rp. ". number_format($data_transaksi['7'], 0, ',', '.');?>
    </td></tr>
        <?php
        // }
        ?>
        <?php
        }
        if($data_transaksi['8']!='0') {
        ?>
        <tr>
            <td colspan="4" class="bold" align="right">Diskon
        </td>
        <td align="right" class="bold">
    <?php
        echo "10%";
        echo "<br>";
        $diskon = $grand_total['0'] * ($data_transaksi['8'] / 100);
        echo "Rp. ". number_format($diskon, 0, ',', '.');
    ?>
    </td>
        </tr>
        <?php
        } else {
            $diskon = 0;
        }
        ?>
        <tr>
            <td colspan="4" class="bold" align="right">Total Keseluruhan</td>
            <td align="right" class="bold">
        <?php
            $total_keseluruhan = ($grand_total['0']+$data_transaksi['7']+$pajak)-$diskon;
            echo "Rp. ". number_format($total_keseluruhan, 0, ',', '.');
        ?>
        </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<!-- tabel transaksi -->

<!-- tombol bayar sekarang -->
<?php
	if($_SESSION['role']=='admin'||$_SESSION['role']=='kasir'){
?>
<form action="dashboard.php?page=detail&id_transaksi=<?=$idtransaksi?>" method="post">
    <table>
        <tr>
            <td><?php if($data_transaksi['11']=='dibayar') { echo ""; } else {
            ?>
            <input type="submit" id="submit" name="bayar_sekarang" value="Bayar Sekarang?" onclick="return confirm('Apakah mau bayar sekarang?')"></td>
            <?php
            }
            ?>
        </tr>
    </table>
</form>
<?php
	}
?>
<br>
</div>
</div>

</center>
<!-- tombol bayar sekarang -->