<?php
    include "koneksi.php";
    session_start();
    
	if(!@$_SESSION['username']){
        echo "<script>alert('Login terlebih dahulu!');window.location.href='index.php'</script>";
    } 
    
    // echo $_SESSION['role'];
    // $_SESSION;

    // if($_SESSION['role']=='admin') {
        $page = $_GET['page'];
    //     $addbtn = "<div class='addbtn'><a href='dashboard.php?page=add$page'>Tambah</a></div>";
        // echo "test";
    // }
    // elseif($_SESSION['role']!='admin') {
    //     $page = $_GET['page'];
    //     $addbtn = "";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.2.1-web/css/fontawesome.min.css">
	<link rel="stylesheet" href="./css/main.css">
    <!-- <title>Dashboard</title> -->
    <style>
        @media print{
        .tidak_print{
            display: none !important;
        }
        #edit {
            display: none !important;
        }
        #delete {
            display: none !important;
        }
        .containtable {
            margin: auto !important;
        }
    }
    </style>
</head>
<body>
    <?php
    $editbtn = "<i class='fa fa-edit'></i>";
    $delbtn = "<i class='fa fa-trash'></i>";

    // if($page == 'main') {
    //     echo "";
    // } else if ($page == $page) {
    //     echo "<button onclick='display()'>Cetak</button>
    //     <script>
    //         function display() {
    //             window.print();
    //         }
    //     </script>";
    // }

    // if($page == 'main') {
    //     echo "";
    // } else if (preg_match('(add|edit)', $page) == false) {
    //     echo "<button class='tidak_print' onclick='display()'>Cetak</button>
    //     <script>
    //         function display() {
    //             window.print();
    //         }
    //     </script>";
    // } else {
    //     echo "";
    // }
    ?>
