<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_supplier = $_POST['id_supplier'];
    $namaobat = $_POST['namaobat'];
    $kategoriobat = $_POST['kategoriobat'];
    $hargajual = $_POST['hargajual'];
    $hargabeli = $_POST['hargabeli'];
    $stok_obat = $_POST['stok_obat'];
    $keterangan = $_POST['keterangan'];

    $insertQuery = "INSERT INTO tb_obat (id_supplier, namaobat, kategoriobat, hargajual, hargabeli, stok_obat, keterangan) VALUES ('$id_supplier', '$namaobat', '$kategoriobat', '$hargajual', '$hargabeli', '$stok_obat', '$keterangan')";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: obat.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "../components/header.php"; ?>
<div class="container mt-5">
    <h2>Create Obat</h2>
    <form method="post">
        <div class="form-group">
            <label>ID Supplier</label>
            <input type="text" name="id_supplier" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" name="namaobat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kategori Obat</label>
            <input type="text" name="kategoriobat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="hargajual" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="hargabeli" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Stok Obat</label>
            <input type="number" name="stok_obat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?php include "../components/footer.php"; ?>