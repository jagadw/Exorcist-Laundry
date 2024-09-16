<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <?php
        @include '../template/cookies.php';
    ?>
    <title>Tambah Paket</title>
   
    <br>
    <h1 align="center">TAMBAH PAKET</h1>
    <form action="./paket/proses.php" method="post">
    <table class="formtable" border="0" align="center">
        <!-- <tr>
            <td>Id Obat</td>
            <td><input name="idobat" type="text"></td>
        </tr> -->
        <tr>
            <td>Outlet</td>
            <td><select name="id_outlet" value="" id="">
            <?php
        // include "../koneksi.php";
        $query = "SELECT * FROM tb_outlet";
        $data = mysqli_query($koneksi, $query);
        while($baris = mysqli_fetch_assoc($data)){
        ?>
        <option value="<?=$baris['id'];?>"><?=$baris['nama'];?></option>
        <?php
        }
    ?>
            </select>
        </td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>
                <select name="jenis" id="">
                    <option value="kiloan">kiloan</option>
                    <option value="selimut">selimut</option>
                    <option value="bed_cover">bed_cover</option>
                    <option value="kaos">kaos</option>
                    <option value="lain">lain-lain</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nama Paket</td>
            <td><input name="nama_paket" type="text"></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><input name="harga" type="text"></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" value="Simpan" id="submit"></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>

    </table>
    </form>

<!-- </body>
</html> -->