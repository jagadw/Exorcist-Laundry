<?php
include "../koneksi.php";
session_start();
$tgl_awal = $_POST['masukkan_tgl_awal'];
$tgl_akhir = $_POST['masukkan_tgl_akhir'];
?>

<html>
<head>
<title>Cetak Laporan</title>
<style>
.outlet {
    background-color: yellow;
    /* warna element nama outlet menjadi warna kuning */
}
@media print {
.outlet {
    background-color: yellow !important;
    -webkit-print-color-adjust: exact;
    /* ketika print maka warna yang ada di web juga ikut di print */
    }
}
</style>
</head>
<body>
<h2 class="align-center">LAPORAN TRANSAKSI LAUNDRY </h2>
<h3>Periode: <?=$tgl_awal." sampai ".$tgl_akhir; ?> </h3>
<!-- algoritma mencari data nama paket yang sering dipilih -->
<?php
if (@$_SESSION['role']=='admin' OR @$_SESSION['role']=='owner'){
    $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id = tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' GROUP BY nama_paket ORDER BY `jumlah_penggunaan` DESC"));
}else{
    $id_outlet = $_SESSION['id_outlet'];
    $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, COUNT(nama_paket) AS jumlah penggunaan FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id = tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY nama_paket  ORDER BY jumlah penggunaan DESC"));
}
echo "Paket yang sering dipilih pelanggan <b>".$nama_paket ['nama_paket']."</b>";
?>
<!-- algoritma mencari data nama paket yang sering dipilih -->
<hr style="width: 100%", size="3", color="black"> <!-- garis hitam -->
<hr>
<?php
if (@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner'){
    $query_outlet = mysqli_query($koneksi, "SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
    INNER JOIN tb_transaksi ON tb_detail_transaksi. id_transaksi=tb_transaksi.id
    INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' GROUP BY tb_outlet.id");
}else{
    $id_outlet = $_SESSION['id_outlet'];
    $query_outlet = mysqli_query($koneksi, "SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
    INNER JOIN tb_transaksi ON tb_detail_transaksi. id_transaksi=tb_transaksi.id
    INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY tb_outlet.id");
}
?>
<center>
<table border="1" cellpadding="10" cellspacing="0">
<?php
$total_semua = 0;
while($baris_outlet = mysqli_fetch_assoc($query_outlet)) {
if (@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner'){
$id_outlet = $baris_outlet['id_outlet'];
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi. id_transaksi=tb_transaksi.id
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
INNER JOIN tb_paket ON tb_detail_transaksi. id_paket=tb_paket.id
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice"); 
}else{
$id_outlet = $_SESSION['id_outlet'];
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice");
}
?>
<tr>
<td align="left" class="outlet" colspan="3">Nama Outlet :
<b><?=$baris_outlet['nama_outlet']?></b>
</td>
</tr>
<?php
$no= 1;
while($baris = mysqli_fetch_assoc($query)){
?>
<tr>
<td><?=$no++?></td>
<td><?="Pelanggan: ".$baris['nama_member']?></td>
<td align="left">
<?php
$id_transaksi = $baris['id_transaksi'];
$query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'");
while($data_paket = mysqli_fetch_assoc($query_paket)){
echo $data_paket['nama_paket']."<br>";
echo "";
}
?>
</td>
<td>
<?php
$grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT hargatotal FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
$pajak = $grand_total['0'] * $baris['pajak'];
$diskon = $grand_total['0'] * $baris['diskon'];
$total_keseluruhan = ($grand_total['0']+$baris['biaya_tambahan']+$pajak-$diskon);
settype($total_keseluruhan, "integer");
$tampil_total = number_format($total_keseluruhan, 0, ',', '.');
$total_semua += $total_keseluruhan;
echo "Total Harga: <b>Rp. ".$tampil_total."</b>";
?>
</td>

</tr>
<?php
    }// tutup while di line 106
}// tutup while di line 81
?>
<tr align="right">
<td colspan="3"><b>Total Pendapatan</b>

<?php echo "<br>Dari tanggal ".$tgl_awal." sampai ".$tgl_akhir; ?>
</td>
<td>
<?php
echo "<h2>Rp.". number_format($total_semua, 0, ',', '.')."</h2>";
$pajak_semua = $total_semua * 0.0075;
echo "Pajak";
echo "Rp.. ".number_format($pajak_semua, 0, ',', '.');
?>
</td>
</tr>
</table>
<?php

?>
</center>
<script>
window.print(); //auto ngeprint
</script>
</body>
</html>