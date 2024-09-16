<?php
if (@$_GET['status']=='baru') {
$status = "WHERE status='baru'";
} else if (@$_GET['status'] == 'proses') {
$status = "WHERE status='proses'";
} else if (@$_GET['status']=='selesai'){
$status = "WHERE status='selesai'";
} else if (@$_GET['status']=='diambil'){
$status = "WHERE status='diambil'";
} else {
$status = "";
}
//jika ada name=status dikirim menggunakan method GET dari line 67 maka variabel $status akan diisi sesuai status yang dikirim mempengaruhi $query line 20 dan 33
if(@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner'){
//jika login sebagai admin atau owner, tampilkan semua transaksi di database tanpa where id outlet
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id $status GROUP BY kode_invoice");
} else {
$id_outlet = $_SESSION['id_outlet'];
if($status!="") {
//menampilkan transaksi berdasarkan outlet yang terdaftar di tb_user jika login sebagai kasir
//ambil dari $_SESSION['id_outlet'] dikirim dari proses_login_dekripsi.php
$outlet = "AND tb_outlet.id='$id_outlet'";
} else{
$outlet = "WHERE tb_outlet.id='$id_outlet'";
}
//mempengaruhi query line 33 ketika $status (line 2 - 12) tidak kosong maka query akan menambahkan (AND tb_outlet. id='$id_outlet) //mempengaruhi query line 33 ketika $status (line 2 - 12) kosong/tidak ada maka query akan menjadi (WHERE tb_outlet. id='$id_outlet')
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id $status $outlet GROUP BY kode_invoice");
}
?>

<center>
<br><br>

<form action="laporan/cetak_laporan.php" target="_blank" method="POST">
<table class="datatable">
<th><span>Tanggal Awal</span></th>
<th><input type="date" class="inputcetak" name="masukkan_tgl_awal" required></th>
<th><span>Tanggal Akhir</span></th>
<th><input type="date" class="inputcetak" name="masukkan_tgl_akhir" id="inputtglakhir" value="" required readonly></th>
<script>
const inputtglakhir = document.querySelector('#inputtglakhir');
inputtglakhir.valueAsDate = new Date();
</script>
<th><button type="submit" name="tombol_cetak_laporan" class="submit">Generate Laporan</button></th>
</table>
</form>

<table class="datatable" cellspacing="0">
<!-judul kolom !->
<thead>
<tr>
<th>Kode Invoice</th>
<th>Nama Pelanggan</th>
<th>Nama Paket</th>
<th>
<select name="pilih_status" class="inputcetak" onchange="status (this.options [this.selectedIndex].value)"> <option value="">
Semua Status
</option>
<option value="baru" <?php if (@$_GET['status'] == 'baru') { echo "selected"; } ?>> Baru
</option>
<option value="proses" <?php if (@$_GET['status'] == 'proses') {echo "selected"; } ?>>
Proses
</option>
<option value="selesai" <?php if (@$_GET['status']=='selesai') { echo "selected";}?>> Selesai
</option>
<option value="diambil" <?php if (@$_GET['status']=='diambil') { echo "selected";}?>>
Diambil
</option>
</select>
<script>
function status (value) {
window.location.href = 'dashboard.php?page=cetak&status=' + value;
}
</script>
</th>
</tr>
</thead>
<!-judul kolom !->
<tbody>
<?php
while($baris = mysqli_fetch_assoc($query)){
if (@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner'){
//jika login sebagai admin/owner maka baris nama outlet akan muncul
?>
<!-- <tr>
<td align="left">Nama Outlet <b><?//=$baris ['nama_outlet']?></b></td>
</tr> -->
<?php
}
?>
<tr>
<td align="left">
<?php
echo "Outlet : <b>";
echo $baris['nama_outlet'];
echo "</b><br>";
$pecah_string_tanggal = explode(" ", $baris ['batas_waktu']); $pecah_string_hari = explode("-", $pecah_string_tanggal['0']); $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);
echo "Batas Pengambilan: ".$pecah_string_hari ['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0']; echo "<br>";
echo "Jam: ".$pecah_string_jam ['0'].":".$pecah_string_jam['1'];
echo "<br>";
echo "<b>".$baris ['kode_invoice']."<b>";
?>
</td>
<td><?=$baris ['nama_member']?></td>
<td align="left">
<?php
$id_transaksi = $baris ['id_transaksi'];
$query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'");
while($data_paket = mysqli_fetch_assoc($query_paket)){
    echo $data_paket['nama_paket'];
    echo "<br>";
}
    echo "";
$grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(hargatotal) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
$pajak = $grand_total ['0'] * $baris['pajak'];
$diskon = $grand_total['0'] * $baris ['diskon'] / 100;
$total_keseluruhan = ($grand_total ['0']+$baris['biaya_tambahan']+$pajak)-$diskon;
echo "Total Harga: <b>Rp.". number_format($total_keseluruhan, 0, ',', '.')."</b>";
?>
</td>
<td>
<select class="inputcetak" onchange="pilihStatus (this.options[this.selectedIndex].value, <?=$baris ['id_transaksi']?>)"> <option value="baru" <?php if ($baris ['status']=='baru') {echo "selected";}?>> Baru
</option>
<option value="proses" <?php if ($baris ['status'] == 'proses') { echo "selected"; } ?>>
Proses
</option>
<option value="selesai" <?php if($baris ['status']=='selesai') { echo "selected";}?>> Selesai
</option>
<option value="diambil" <?php if($baris ['status']=='diambil') { echo "selected"; } ?>>
Diambil
</option>
</select>
<script>
function pilihStatus (value, id) {
window.location.href = 'transaksi/edit.php?status=' + value + '&id=' + id;
}
</script>
<?php
if ($baris ['dibayar'] == 'belum_dibayar') {
    $warna = "#ffc300"; //kuning
}else{
    $warna = "#32de00"; //hijau
}
?>

<br>
<div class="cekdetail">
<a href="dashboard.php?page=detail&id_transaksi=<?=$baris ['id_transaksi']?>">
<span style="color: <?=$warna?>; font-weight: 800;">•</span>
<span style="font-size: small; color: #fff;"> Cek Detail</span>
</a>
</div>
</td>
</tr>
<?php
}
?>
</tbody>
</table>

</center>