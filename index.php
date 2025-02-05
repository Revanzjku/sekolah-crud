<?php 
    require 'includes/connect.php';

    $query = "SELECT *, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
            LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
    ";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " WHERE nama_siswa LIKE '%$search%' OR
                        jenis_kelamin LIKE '%$search%' OR
                        tempat_lahir LIKE '%$search%' OR
                        tanggal_lahir LIKE '%$search%' OR
                        nama_kelas LIKE '%$search%' OR
                        nama_wali LIKE '%$search%'";
    }
    $query .= " ORDER BY nis ASC";
    $result = mysqli_query($conn, $query);
    // Pagination
    $total_records = mysqli_num_rows($result);
    $per_page = 5; // Jumlah data per halaman
    $total_pages = ceil($total_records / $per_page);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page;
    $query .= " LIMIT $start_from, $per_page";
    $result = mysqli_query($conn, $query);
    echo "<script>window.history.replaceState(null, null, 'index.php');</script>";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Siswa</h2>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="views/kelas.php" class="btn btn-primary">Kelola Kelas</a>
                <a href="views/wali_murid.php" class="btn btn-primary">Kelola Wali Murid</a>
            </div>
            <form action="" method="GET" class="d-flex">
                <input type="search" name="search" class="form-control me-2" placeholder="Cari kelas..." value="<?= isset($search) ? $search : ''; ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <div>
                <a href="actions/tambah_siswa.php" class="btn btn-success">Tambah Siswa</a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Kelas</th>
                <th>Wali Murid</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row["nis"]; ?></td>
                        <td><?= $row["nama_siswa"]; ?></td>
                        <td><?= $row["jenis_kelamin"]; ?></td>
                        <td><?= $row["tempat_lahir"]; ?></td>
                        <td><?= $row["tanggal_lahir"]; ?></td>
                        <td><?= $row["nama_kelas"]; ?></td>
                        <td><?= $row["nama_wali"]; ?></td>
                        <td>
                            <a href="actions/edit_siswa.php?id=<?= $row["id_siswa"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="actions/hapus_siswa.php?id=<?= $row["id_siswa"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>&search=<?= isset($search) ? $search : ''; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>