<?php

// $host = 'your_host';
// $username = 'root';
// $database = 'apotek';

// $koneksi = mysqli_connect("$host","$username","$password","$database");

$koneksi = mysqli_connect("localhost","","","databaselaundry");

if(!$koneksi) {
    die ("Koneksi Ke Database Gagal!". mysqli_connect_error($koneksi));
}

// $loggerpath = dirname(__FILE__) . "/logger.txt";
// function logger(string $name, string $msg): void {
//     global $loggerpath;
//     $current = "";
    
    
//     if (file_exists($loggerpath))
//     $current = file_get_contents($loggerpath);

//     $date = date("Y/m/d h:m:s A");
//     file_put_contents($loggerpath, $current . "[$date] [$name]: $msg\n");
//     // exit("$loggerpath");
// }

?>
