<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];

    $query_cek = "SELECT COUNT(*) as total FROM siswa WHERE id_wali = $id";
    $result_cek = mysqli_query($conn, $query_cek);
    $data = mysqli_fetch_assoc($result_cek);

    if($data["total"] > 0) {
        echo "
            <script>
                alert('Tidak bisa menghapus karena masih ada siswa terdaftar!');
                document.location.href = '../views/wali_murid.php';
            </script>
        ";
    } else {
        $delete = "DELETE FROM wali_murid WHERE id_wali = $id";
        mysqli_query($conn, $delete);
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Wali Murid berhasil dihapus!')
                document.location.href = '../views/wali_murid.php'; 
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Wali Murid gagal dihapus!')
                document.location.href = '../views/wali_murid.php'; 
            </script>
            ";
        }
    }
?>