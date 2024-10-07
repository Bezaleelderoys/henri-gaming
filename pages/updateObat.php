<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tb_obat WHERE id_obat='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Obat not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_supplier = $_POST['id_supplier'];
    $namaobat = $_POST['namaobat'];
    $kategoriobat = $_POST['kategoriobat'];
    $hargajual = $_POST['hargajual'];
    $hargabeli = $_POST['hargabeli'];
    $stok_obat = $_POST['stok_obat'];
    $keterangan = $_POST['keterangan'];

    $updateQuery = "UPDATE tb_obat SET 
        id_supplier='$id_supplier', 
        namaobat='$namaobat', 
        kategoriobat='$kategoriobat', 
        hargajual='$hargajual', 
        hargabeli='$hargabeli', 
        stok_obat='$stok_obat', 
        keterangan='$keterangan' 
        WHERE id_obat='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: obat.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<?php include "../components/header.php"; ?>
<div class="container mt-5">
    <h2>Update Obat</h2>
    <form method="post">
        <div class="form-group">
            <label>ID Supplier</label>
            <input type="text" name="id_supplier" class="form-control" value="<?= $data['id_supplier'] ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" name="namaobat" class="form-control" value="<?= $data['namaobat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Kategori Obat</label>
            <input type="text" name="kategoriobat" class="form-control" value="<?= $data['kategoriobat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="hargajual" class="form-control" value="<?= $data['hargajual'] ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="hargabeli" class="form-control" value="<?= $data['hargabeli'] ?>" required>
        </div>
        <div class="form-group">
            <label>Stok Obat</label>
            <input type="number" name="stok_obat" class="form-control" value="<?= $data['stok_obat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" required><?= $data['keterangan'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include "../components/footer.php"; ?>