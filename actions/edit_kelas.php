<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas=$id");
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama_kelas = $_POST["nama_kelas"];

        $update = "UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas=$id";

        mysqli_query($conn, $update);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Data Kelas berhasil diubah!')
                    document.location.href = '../views/kelas.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Kelas gagal diubah!')
                    document.location.href = '../views/kelas.php'; 
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
    <title>Edit Data Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required placeholder="Masukkan Nama Kelas" value="<?= $row["nama_kelas"]; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../views/kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>