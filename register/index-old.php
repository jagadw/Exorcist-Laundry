<?php
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        table {
            box-shadow: 0 3px 20px rgba(0,0,0,0.3);
            padding: 20px;
            padding-bottom: 30px;
            font-weight: bolder;
            border-radius: 8px;
        }
        td input, select {
            margin-bottom: 8px;
            margin-left: 10px;
            border-radius: 5px;
            padding-bottom: 8px;
        }
        h1 {
            color: #ff9800;
        }
        #submit {
            margin-top: 10px;
            background-color: #00adef;
            border-radius: 8px;
            color: #fff;
            border-color: #019eed;
            padding: 10px;
            font-weight: bold;
        }
        hr {
            margin-top: 8px;
        }
        a {
            margin-top: 10px;
            font-size: small;
            text-decoration: none;
            color: #00adef;
            float: right;
        }
    </style>
</head>
<body>
<h1 align="center">REGISTER</h1>
<form action="encrypt.php" method="post">
    <table align="center">
    <tr>
        <td>Nama Karyawan</td>
            <td><select name="idkaryawan" value="" id="">
            <?php
        include "koneksi.php";
        $query = "SELECT * FROM tb_karyawan WHERE idkaryawan NOT IN (SELECT idkaryawan FROM tb_login);";
        $data = mysqli_query($koneksi, $query);
        $cek = mysqli_num_rows($data);
        if ($cek > 0) {
        while($baris = mysqli_fetch_assoc($data)){
        ?>
        <option value="<?=$baris['idkaryawan'];?>"><?=$baris['namakaryawan'];?></option>
        <?php
        }
    } else {
        ?>
        <option value="">Semua karyawan telah register</option>
        <?php
    }
    ?>
            </select>
        </td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Level User</td>
            <td><select name="leveluser" id="">
                <option value="admin">admin</option>
                <option value="karyawan">karyawan</option>
            </select></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" value="Simpan" id="submit"></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td colspan="3"><a href="../index.php">Login</a></td>
        </tr>
    </table>
    </form>
</body>
</html>