<?php 
    $conn = mysqli_connect("localhost", "root", "", "sekolah");

    if (!$conn) {
        die("Koneksi gagal : " . mysqli_connect_error());
    }
?>