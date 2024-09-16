<?php
    include_once './template/header.php';
    include_once './template/navbar.php';
    include_once './template/addbtn.php';

    // if (!isset($_COOKIE['username'])) {
    //     header("location: index.php");
    // }
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $id_user = $_SESSION['id_user'];
    $id_outlet = $_SESSION['id_outlet'];
?>
    <!-- <h3>Selamat Datang! Kak <?= $logged['leveluser']; ?> <?= $logged['username']; ?></h3>
    <p><a id="logout" href="logout.php">Logout</a></p> -->

<?php
    switch($_GET['page']) {
    case 'main':
		?>
		<title>Dashboard</title>
    </head>
    <body>
        <div class="dashboard">
            <h1 style="color: white;">Statistik</h1>
            <div class="content">
                <div class="box transparent">
                    <div class="icon">
                        <i class="fa fa-user"></i>
                        <?php
                        $cekuser = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_user");
                        $jumlahuser = mysqli_fetch_assoc($cekuser);
                        ?>
                    <h3>User
                        <br>
                        <center class="stats"><?=$jumlahuser['total']?></center>
                    </h3>
                    </div>
                </div>
                <div class="box transparent">
                    <div class="icon">
                    <i class="fa-solid fa-address-card"></i>
                        <?php
                        $cekmember = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_member");
                        $jumlahmember = mysqli_fetch_assoc($cekmember);
                        ?>
                    <h3>Member
                        <br>
                        <center class="stats"><?=$jumlahmember['total']?></center>
                    </h3>
                </div>
                </div>
                <div class="box transparent">
                    <div class="icon">
                    <i class="fa-solid fa-building"></i>
                        <?php
                        $cekoutlet = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_outlet");
                        $jumlahoutlet = mysqli_fetch_assoc($cekoutlet);
                        ?>
                    <h3>Outlet
                        <br>
                        <center class="stats"><?=$jumlahoutlet['total']?></center>
                    </h3>
                    </div>
                </div>
                <div class="box transparent">
                    <div class="icon">
                    <i class="fa-solid fa-box"></i>
                        <?php
                        $cekpaket = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_paket");
                        $jumlahpaket = mysqli_fetch_assoc($cekpaket);
                        ?>
                    <h3>Paket
                        <br>
                        <center class="stats"><?=$jumlahpaket['total']?></center>
                    </h3>
                    </div>
                </div>
            </div>
        </div>
    </body>
		<?php
    break;
    case 'paket':
        include_once './paket/view-paket.php';
    break;
    case 'addpaket':
        include_once './paket/index.php';
    break;
    case 'editpaket':
        include_once './paket/edit.php';
    break;
    case 'member':
        include_once './member/view-member.php';
    break;
    case 'addmember':
        include_once './member/index.php';
    break;
    case 'editmember':
        include_once './member/edit.php';
    break;
    case 'outlet':
        include_once './outlet/view-outlet.php';
    break;
    case 'addoutlet':
        include_once './outlet/index.php';
    break;
    case 'editoutlet':
        include_once './outlet/edit.php';
    break;
    case 'addtransaksi':
        include_once './transaksi/index.php';
    break;
    case 'cetak':
        include_once './laporan/cetak.php';
    break;
    case 'detail':
        include_once './transaksi/view-detail.php';
    break;
    case 'user':
        include_once './user/view-user.php';
    break;
    case 'edituser':
        include_once './user/edit.php';
    break;
    default;
}
include_once './template/footer.php';
?>