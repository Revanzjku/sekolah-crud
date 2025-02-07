<?php 
    require '../includes/connect.php';
    
    $query = "SELECT * FROM wali_murid";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " WHERE nama_wali LIKE '%$search%' OR
                            kontak LIKE '%$search%'";
    }
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
    echo "<script>window.history.replaceState(null, null, 'wali_murid.php');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Data Wali Murid</h2>
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-3">
                <a href="../index.php" class="btn btn-primary w-100 w-md-auto">Kembali ke Data Siswa</a>
            </div>
            <div class="col-12 col-md-6">
                <form action="" method="GET" class="d-flex search-from">
                    <input type="search" name="search" class="form-control me-2" placeholder="Cari kelas..." value="<?= isset($search) ? $search : ''; ?>">
                    <button type="submit" class="btn btn-success">Cari</button>
                </form>
            </div>
            <div class="col-12 col-md-3 text-md-end">
                <a href="../actions/tambah_wali.php" class="btn btn-success w-100 w-md-auto">Tambah Wali Murid</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark text-center">
                    <th style="width: 35%">Nama Wali</th>
                    <th style="width: 35%">No. Telepon</th>
                    <th style="width: 30%">Aksi</th>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr class="text-center">
                            <td><?= $row["nama_wali"]; ?></td>
                            <td><?= $row["kontak"]; ?></td>
                                <td>
                                    <div class="table-actions d-flex justify-content-center gap-2">
                                        <a href="../actions/edit_wali.php?id=<?= $row["id_wali"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="../actions/hapus_wali.php?id=<?= $row["id_wali"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </div>
                                </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <nav class="mt-3">
            <ul class="pagination pagination-sm flex-wrap justify-content-center">
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