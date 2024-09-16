<link rel="stylesheet" href="fontawesome-free-6.2.1-web/css/all.min.css" />
    <!-- Responsive CSS Navbar -->
    <nav class="topnav tidak_print" id="myTopnav">
		<div style="width: 100%;display:flex;justify-content: space-between;">
        <a href="dashboard.php?page=main" id="homebtn" class="active"><img src="img/logo.png"></a>
		<a href="javascript:void(0);" class="icon" onclick="show()">
			<i class="fa fa-bars"></i>
		</a>
		</div>
        <span id="currenttime">00:00:00</span>
		<div class="corenav">
		<div>
        <?php
        if ($_SESSION['role']=="owner" || $_SESSION['role']=="admin") {
        ?>
        <a class="navlink" href="dashboard.php?page=outlet">Outlet</a>
        <a class="navlink" href="dashboard.php?page=paket">Paket</a>
        <a class="navlink" href="dashboard.php?page=user">User</a></td>
        <?php
        } if ($_SESSION['role']=="owner" || $_SESSION['role']=="admin" || $_SESSION['role']=="kasir") {
        ?>
        <a class="navlink" href="dashboard.php?page=member">Member</a>
        <?php
        } if ($_SESSION['role']=="admin" || $_SESSION['role']=="kasir") {
        ?>
        <a class="navlink" href="dashboard.php?page=addtransaksi">Transaksi</a>
        <!-- <a class="navlink" href="dashboard.php?page=cetak">Cetak</a> -->
        <?php
        } if ($_SESSION['role']=="owner" || $_SESSION['role']=="admin" || $_SESSION['role']=="kasir") {
        ?>
        <!-- <a class="navlink" href="dashboard.php?page=addtransaksi">Transaksi</a> -->
        <a class="navlink" href="dashboard.php?page=cetak">Cetak</a>
        <?php
        } if ($_SESSION['role']=="admin") {
        ?>
        <a class="navlink" href="register/index.php">Register</a></td>
        <a class="navlink" href="recovery/index.php">Recovery</a></td>
        <?php
            }
        ?>

		</div>

		<div class="dropdownbox"><a class="navlink" onclick="showdropdown()" href="#"><i class="fa-solid fa-user"></i> <?=$_SESSION['username']?></a>
			<div class="dropdowncontent">
				<a id="logoutbtn" class="navlink" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
			</div>
		</div>
		</div>

    </nav>

    <!-- Content Here -->
