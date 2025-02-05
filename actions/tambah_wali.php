<?php 
    require '../includes/connect.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama_wali = $_POST["nama_wali"];
        $no_telp = $_POST["no_telp"];

        $query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES('$nama_wali', '$no_telp')";

        mysqli_query($conn, $query);
        
        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Wali Murid berhasil ditambahkan!')
                    document.location.href = '../views/wali_murid.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Wali Murid gagal ditambahkan!')
                    document.location.href = 'tambah_wali.php'; 
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
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" required placeholder="Masukkan Nama Wali">
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" required placeholder="Masukkan No. Telepon">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../views/wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>