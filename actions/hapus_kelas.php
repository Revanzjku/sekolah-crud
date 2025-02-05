<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];

    $query_cek = "SELECT COUNT(*) as total FROM siswa WHERE id_kelas = $id";
    $result_cek = mysqli_query($conn, $query_cek);
    $data = mysqli_fetch_assoc($result_cek);

    if($data["total"] > 0) {
        echo "
            <script>
                alert('Tidak bisa menghapus kelas ini karena masih ada siswa terdaftar!');
                document.location.href = '../views/kelas.php';
            </script>
        ";
    } else {
        $delete = "DELETE FROM kelas WHERE id_kelas = $id";
        mysqli_query($conn, $delete);
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Kelas berhasil dihapus!')
                document.location.href = '../views/kelas.php'; 
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Kelas gagal dihapus!')
                document.location.href = '../views/kelas.php'; 
            </script>
            ";
        }
    }
?>