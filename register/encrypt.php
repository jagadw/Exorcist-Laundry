<?php
    include '../koneksi.php';
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pass_hash = password_hash($password, PASSWORD_DEFAULT); // meng-enkripsi password
    $role = $_POST['role'];
    $id_outlet = $_POST['id_outlet'];

    $query_username = mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_user WHERE username='$username'");
    $check_username = mysqli_fetch_row($query_username);

    if($check_username['0'] != 0) {
        echo "<script>alert('Username sudah ada, silahkan menggunakan username yang lain');window.location.href='index.php'</script>";
    }else if(@$id_outlet == NULL) {
        echo "<script>alert('Pendaftaran akun telah melewati batas');window.location.href='index.php'</script>";
    }else{
        $query = mysqli_query($koneksi, "INSERT INTO tb_user
        VALUES (NULL, '$name', '$username', '$pass_hash', '$id_outlet', '$role')");
        // $hasil = mysqli_query($koneksi, $query);
    if(!$query){
        header('location: index.php?pesan=gagal_register');
    }else{
        header('location: ../dashboard.php?page=user&pesan=berhasil_register');
        exit;
    }
}
?>