<?php
    include "./koneksi.php";
    // mengaktifkan session
    session_start();
    // menghapus semua session
    session_destroy();
    // mengalihkan halaman sambil mengirim pesan logout
    //logger("LOGOUT", "$username sedang logout");
    header("location:index.php?pesan=logout");
?>
