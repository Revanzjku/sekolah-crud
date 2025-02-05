<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];

    mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = $id");

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Siswa berhasil dihapus!')
                document.location.href = '../index.php'; 
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Siswa gagal dihapus!')
                document.location.href = '../index.php'; 
            </script>
            ";
    }
?>