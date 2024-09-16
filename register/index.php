<?php
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/log-reg-rec.css">
	

</head>

<body>
    <div class="formbox">
        <div class="box-half register">
            <!-- <table align="center"> -->
            <h1 align="center">REGISTER</h1>
            <form action="encrypt.php" method="post">
			<div class="formarea">
                <label>Nama</label>
                <input type="text" name="name">

                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
                <input type="password" name="password">

                <label class="karyawan">Outlet</label>
                <select name="id_outlet" value="" class="transparent">
                    <?php
						include "koneksi.php";
						$query = "SELECT * FROM tb_outlet;";
						$data = mysqli_query($koneksi, $query);
						while($baris = mysqli_fetch_assoc($data)){
						?>
									<option value="<?=$baris['id'];?>"><?=$baris['nama'];?></option>
									<?php
						}
					?>
                </select>
                    <label>Role</label>
                    <select name="role" class="transparent">
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                    <input type="submit" class="submit" value="SIGN UP">

                <!-- <button type="button" class="button">Register</button> -->
					<div style="margin: 10px 0;">
					<!--<a class="btmlink" href="../login.php">Login</a>-->
					<a class="btmlink" href="../recovery/index.php">Recovery</a>
					</div>
				</div>
                <div class="skew">
                </div>
            </form>
            <!-- </table> -->
        </div>
				<div class="desc">
					<img src="../img/logo.png" alt="laundryexorcist" width="250px">
					<!-- <h3>Apotek Sehat Terus</h3> -->
				</div>
    </div>

</body>

</html>