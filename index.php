<?php
    require 'includes/connect.php';

    $query = "SELECT *, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
            LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
    ";
    // untuk menjalankan search
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " WHERE nama_siswa LIKE '%$search%' OR
                        jenis_kelamin LIKE '%$search%' OR
                        tempat_lahir LIKE '%$search%' OR
                        tanggal_lahir LIKE '%$search%' OR
                        nama_kelas LIKE '%$search%' OR
                        nama_wali LIKE '%$search%'";
    }
    // mengurutkan data berdasarkan NIS dari kecil ke besar
    $query .= " ORDER BY nis ASC";
    $result = mysqli_query($conn, $query);
    // Pagination
    $total_records = mysqli_num_rows($result);
    $per_page = 5;
    $total_pages = ceil($total_records / $per_page);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_from = ($page - 1) * $per_page;
    // query terakhir setelah dilimit
    $query .= " LIMIT $start_from, $per_page";
    $result = mysqli_query($conn, $query);
    // membersihkan url setelah search
    echo "<script>window.history.replaceState(null, null, 'index.php');</script>";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Data Siswa</h2>
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <div class="action-buttons">
                    <a href="views/kelas.php" class="btn btn-primary mb-2 mb-md-0">Kelola Kelas</a>
                    <a href="views/wali_murid.php" class="btn btn-primary">Kelola Wali Murid</a>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <form action="" method="GET" class="d-flex search-section">
                    <input type="search" name="search" class="form-control me-2" placeholder="Cari kelas..." value="<?= isset($search) ? $search : ''; ?>">
                    <button type="submit" class="btn btn-success">Cari</button>
                </form>
            </div>
            <div class="col-12 col-md-3 text-md-end">
                <a href="actions/tambah_siswa.php" class="btn btn-success w-100 w-md-auto">Tambah Siswa</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark text-center">
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th class="d-none d-md-table-cell">Tempat Lahir</th>
                    <th class="d-none d-md-table-cell">Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th class="d-none d-lg-table-cell">Wali Murid</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr class="text-center">
                            <td><?= $row["nis"]; ?></td>
                            <td><?= $row["nama_siswa"]; ?></td>
                            <td><?= $row["jenis_kelamin"]; ?></td>
                            <td class="d-none d-md-table-cell"><?= $row["tempat_lahir"]; ?></td>
                            <td class="d-none d-md-table-cell"><?= $row["tanggal_lahir"]; ?></td>
                            <td><?= $row["nama_kelas"]; ?></td>
                            <td class="d-none d-lg-table-cell"><?= $row["nama_wali"]; ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="actions/edit_siswa.php?id=<?= $row["id_siswa"]; ?>" class="btn btn-warning btn-sm mb-1 mb-md-0">Edit</a>
                                    <a href="actions/hapus_siswa.php?id=<?= $row["id_siswa"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- navigasi pagination -->
            <nav class="mt-3">
                <ul class="pagination pagination-sm flex-wrap justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>&search=<?= isset($search) ? $search : ''; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <!-- navigasi pagination -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>