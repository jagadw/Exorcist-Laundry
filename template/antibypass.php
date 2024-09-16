<?php
    session_start();
    
    if(@$_SESSION['role']=="admin"){
        echo "";
    } else {
        echo "<script>alert('Dilarang masuk selain admin!');window.location.href='../index.php'</script>";
    }
?>