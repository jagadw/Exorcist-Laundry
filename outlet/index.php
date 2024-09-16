<?php
        @include '../template/cookies.php';
    ?>
    <title>Tambah Outlet</title>
    <h1 align="center">TAMBAH OUTLET</h1>
    <form action="./outlet/proses.php" method="post">
    <table class="formtable" align="center">
        <!-- <tr>
            <td>ID Outlet</td>
            <td><input name="idoutlet" type="text"></td>
        </tr> -->
        <tr>
            <td>Nama Outlet</td>
            <td><input name="nama" type="text"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input name="alamat" type="text"></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td><input name="telp" type="text"></td>
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