<?php 
    require '../includes/connect.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nis = $_POST["nis"];
        $nama_siswa = $_POST["nama_siswa"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $tempat_lahir = $_POST["tempat_lahir"];
        $tanggal_lahir = $_POST["tanggal_lahir"];
        $id_kelas = $_POST["id_kelas"];
        $id_wali = $_POST["id_wali"];

        $query = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali)
            VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali')";

        mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Siswa berhasil ditambahkan!')
                    document.location.href = '../index.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Siswa gagal ditambahkan!')
                    document.location.href = 'tambah_siswa.php'; 
                </script>
            ";
        }
    }
    $query_kelas = "SELECT * FROM kelas";
    $query_wali = "SELECT * FROM wali_murid";
    $result_kelas = mysqli_query($conn, $query_kelas);
    $result_wali = mysqli_query($conn, $query_wali);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4 mb-5">
        <h2 class="mb-3">Tambah Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" required placeholder="Masukkan NIS">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" required placeholder="Masukkan Nama Siswa">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat Lahir">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <option value="Tidak ada data">Kelas</option>
                    <?php while ($row_kelas = mysqli_fetch_assoc($result_kelas)) :?>
                        <option value="<?= $row_kelas['id_kelas']; ?>"><?= $row_kelas['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <option value="Tidak ada data">Nama Wali</option>
                    <?php while ($row_wali = mysqli_fetch_assoc($result_wali)) :?>
                        <option value="<?= $row_wali['id_wali']; ?>"><?= $row_wali['nama_wali']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="../index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>