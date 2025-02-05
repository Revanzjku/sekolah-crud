<?php 
    require '../includes/connect.php';

    $id = $_GET["id"];
    $query = "SELECT *, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
            WHERE id_siswa=$id
    ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $result_kelas = mysqli_query($conn, "SELECT * FROM kelas");
    $result_wali = mysqli_query($conn, "SELECT * FROM wali_murid");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nis = $_POST["nis"];
        $nama_siswa = $_POST["nama_siswa"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $tempat_lahir = $_POST["tempat_lahir"];
        $tanggal_lahir = $_POST["tanggal_lahir"];
        $id_kelas = $_POST["id_kelas"];
        $id_wali = $_POST["id_wali"];

        $update = "UPDATE siswa SET nis='$nis', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', id_kelas='$id_kelas', id_wali='$id_wali' WHERE id_siswa=$id";

        mysqli_query($conn, $update);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Data Siswa berhasil diubah!')
                    document.location.href = '../index.php'; 
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Siswa gagal diubah!')
                    document.location.href = 'edit_siswa.php'; 
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
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4 mb-5">
        <h2 class="mb-3">Edit Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" required placeholder="Masukkan NIS" value="<?= $row["nis"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" required placeholder="Masukkan Nama Siswa" value="<?= $row["nama_siswa"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Jenis Kelamin</option>
                    <option value="L" <?= ($row["jenis_kelamin"] == "L") ? "selected" : ""; ?> >Laki-laki</option>
                    <option value="P" <?= ($row["jenis_kelamin"] == "P") ? "selected" : ""; ?> >Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat Lahir" value="<?= $row["tempat_lahir"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required value="<?= $row["tanggal_lahir"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                <option value="Tidak ada data">Kelas</option>
                    <?php while ($rows = mysqli_fetch_assoc($result_kelas)) :?>
                        <option value="<?= $rows['id_kelas']; ?>" <?= ($row['id_kelas'] == $rows['id_kelas']) ? "selected" : ""; ?>><?= $rows["nama_kelas"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <option value="Tidak ada data">Nama Wali</option>
                    <?php while ($rows = mysqli_fetch_assoc($result_wali)) :?>
                        <option value="<?= $rows['id_wali']; ?>" <?= ($row['id_wali'] == $rows['id_wali']) ? "selected" : "";?>><?= $rows['nama_wali']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="../index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>