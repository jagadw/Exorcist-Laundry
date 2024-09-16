<?php
    if(@$_POST['Proses']) {
        $id_outlet = $_SESSION['id_outlet'];

        @$kode_invoice_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_invoice FROM tb_transaksi ORDER BY id DESC LIMIT 1"));
        $id_invoice = mysqli_query($koneksi, "SELECT id FROM tb_transaksi ORDER BY id DESC LIMIT 1");
        $barisinvoice = mysqli_fetch_assoc($id_invoice);
        $id_inv = $barisinvoice['id'] + 1;

        // if(!$kode_invoice_terakhir) {
            $kode_invoice = "INV-".date("Y/m/d")."/$id_inv";
        // } else {
        //     $pecah_string = explode("/", $kode_invoice_terakhir['kode_invoice']);
        //     $bulan_sebelum = $pecah_string[2];
        //     $bulan_saat_ini = date('m');
        //     if ($bulan_saat_ini != $bulan_sebelum) {
        //         $number_urut = 1;
        //     } else {
        //         $number_urut = $pecah_string[4];
        //         $number_urut++;
        //     }
        //     $kode_invoice = "INV-".date("Y/m/d")."/".$number_urut;
        // }

        $nama_member = $_POST['nama_member'];
        $cari_id_member = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM tb_member WHERE nama = '$nama_member'"));
        $id_member = $cari_id_member['id'];

        date_default_timezone_set('Asia/Makassar');
        $tanggal = date("Y-m-d H:i:s");
        $batas_waktu = date("Y-m-d H:i:s", strtotime($tanggal . " +3 days"));


        
            $tgl_bayar = "NULL";

        if(@$_POST['biaya_tambahan']) {
            $biaya_tambahan = $_POST['biaya_tambahan'];
        } else {
            $biaya_tambahan = 0;
        }

        $cari_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_member FROM tb_transaksi WHERE id_member = '$id_member'"));
        if ($cari_transaksi % 3 == 0 && $cari_transaksi != 0) {
            $diskon = 10;
        } else {
            $diskon = 0;
        }

        $pajak = 0.0075;

        $status = "baru";

        $id_user = $_SESSION['id_user'];

        $hasil = mysqli_query($koneksi, "INSERT INTO tb_transaksi VALUES(NULL, '$id_outlet', '$kode_invoice', '$id_member', '$tanggal', '$batas_waktu', $tgl_bayar, '$biaya_tambahan', '$diskon', '$pajak', '$status', 'belum_dibayar', '$id_user')");
        $id_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT LAST_INSERT_ID()"));
        $_SESSION['id_transaksi'] = $id_transaksi[0];
        if(!$hasil) {
            echo "<script>alert('Member tidak valid!');window.location.href='dashboard.php?page=addtransaksi'</script>";
        } else {
            echo "<script>window.location.href='dashboard.php?page=detail'</script>";
            exit;
        }
    }
?>

<br>
<br>
<center>
    <form action="dashboard.php?page=addtransaksi" class="formtable transparent" method="post">
        <input type="text" list="nama_pelanggan" name="nama_member" autocomplete="off" placeholder="Masukan nama pelanggan">
        <datalist id="nama_pelanggan">
            <?php
            $query_member = mysqli_query($koneksi, "SELECT nama FROM tb_member");
            while($data_pelanggan = mysqli_fetch_assoc($query_member)) {
            ?>
            <option value="<?=$data_pelanggan['nama']?>"></option>
            <?php
            }
            ?>
        </datalist>

        <br><br>
        <!-- <input type="number" name="biaya_tambahan" autocomplete="off" placeholder="Biaya Tambahan">
        <br><br> -->

        <!-- <select name="dibayar" id="">
            <option value="belum_dibayar">Belum dibayar</option>
            <option value="dibayar">Dibayar</option>
        </select><br><br> -->

        <input type="submit" id="submit" value="Proses" name="Proses">
    </form>
</center>