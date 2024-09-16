<?php
    include '../koneksi.php';
    $username = $_POST['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' LIMIT 1");

    $query_username = mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_user WHERE username='$username'");
    $check_username = mysqli_fetch_row($query_username);

    if(mysqli_num_rows($query) > 0){
        $password = $_POST['password'];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT); // meng-enkripsi password
        $re_password = $_POST['re_password'];
        if ($password == $re_password) {
            $update = mysqli_query($koneksi, "UPDATE tb_user SET password='$pass_hash' WHERE username='$username'");
            header('location: ../dashboard.php?page=user&pesan=berhasil_update');
        } else if($password != $re_password) {
            echo "<script>alert('Password tidak sesuai');window.location.href='index.php'</script>";
        }
    }else if($check_username['0'] == 0){
        echo "<script>alert('Username tersebut tidak terdaftar');window.location.href='index.php'</script>";
    }else{
        echo "<script>alert('Gagal mengubah password');window.location.href='index.php'</script>";
    }
?>