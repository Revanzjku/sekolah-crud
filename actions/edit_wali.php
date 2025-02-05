<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM wali_murid WHERE id_wali=$id");
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama_wali = $_POST["nama_wali"];
        $kontak = $_POST["no_telp"];

        $update = "UPDATE wali_murid SET nama_wali='$nama_wali', kontak='$kontak' WHERE id_wali=$id";
        mysqli_query($conn, $update);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Data Wali Murid berhasil diubah!')
                    document.location.href = '../views/wali_murid.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Wali Murid gagal diubah!')
                    document.location.href = '../views/wali_murid.php'; 
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" required placeholder="Masukkan Nama Wali" value="<?= $row["nama_wali"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" required placeholder="Masukkan No. Telepon" value="<?= $row["kontak"]; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../views/wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>