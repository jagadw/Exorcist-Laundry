<?php
	@include '../template/cookies.php';
?>
    <title>Tambah Member</title>
<h1 align="center">TAMBAH MEMBER</h1>
<form action="./member/proses.php" method="post">
    <table class="formtable" align="center">
        <!-- <tr>
            <td>ID Member</td>
            <td><input type="text" name="idmember"></td>
        </tr> -->
        <tr>
            <td>Nama Member</td>
            <td><input type="text" name="namamember"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><select name="jeniskelamin" id="">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td><input type="text" name="telp"></td>
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