<?php
    include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery</title>
	    <link rel="stylesheet" href="../css/log-reg-rec.css">
</head>
<body>
<div class="formbox">
        <div class="box-half register">
            <!-- <table align="center"> -->
            <h1 align="center">PASSWORD RECOVERY</h1>
            <form action="proses.php" method="post">
			<div class="formarea">                
                    <label>Username</label>
                    <input type="text" name="username">

                    <label>New Password</label>
                    <input type="password" name="password">
                    <label>Retype New Password</label>
                    <input type="password" name="re_password">
                    <input type="submit" class="submit" value="RESET">

                <!-- <button type="button" class="button">Register</button> -->
					<div style="margin: 10px 0;">
					<a class="btmlink" href="../index.php">Login</a>
					<a class="btmlink" style="margin-left: 7px;" href="../register/index.php">Register</a>
					</div>
				</div>
                <div class="skew">
                </div>
            </form>
            <!-- </table> -->
        </div>
				<div class="desc">
					<img src="../img/logo.png" alt="" width="250px">
					<!-- <h3>Apotek Sehat Terus</h3> -->
				</div>
    </div>

</body>
</html>