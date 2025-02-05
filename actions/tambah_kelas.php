<?php 
    require '../includes/connect.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama_kelas = $_POST["nama_kelas"];

        $query = "INSERT INTO kelas (nama_kelas) VALUES('$nama_kelas')";

        mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Kelas berhasil ditambahkan!')
                    document.location.href = '../views/kelas.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Kelas gagal ditambahkan!')
                    document.location.href = 'tambah_kelas.php'; 
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
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required placeholder="Masukkan Nama Kelas">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../views/kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>