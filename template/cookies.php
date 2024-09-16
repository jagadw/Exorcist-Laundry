<?php
    session_start();
    if(!@$_SESSION['username']){
    echo "<script>alert('Login terlebih dahulu!');window.location.href='../index.php'</script>";
    }
    ?>