<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE idtransaksi='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Transaction not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idpelanggan = $_POST['idpelanggan'];
    $idkaryawan = $_POST['idkaryawan'];
    $tgltransaksi = $_POST['tgltransaksi'];
    $kategoripelanggan = $_POST['kategoripelanggan'];
    $totalbayar = $_POST['totalbayar'];
    $bayar = $_POST['bayar'];
    $kembali = $_POST['kembali'];

    $updateQuery = "UPDATE tb_transaksi SET 
        idpelanggan='$idpelanggan', 
        idkaryawan='$idkaryawan', 
        tgltransaksi='$tgltransaksi', 
        kategoripelanggan='$kategoripelanggan', 
        totalbayar='$totalbayar', 
        bayar='$bayar', 
        kembali='$kembali' 
        WHERE idtransaksi='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: transaksi.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<?php include "header.php"; ?>
<div class="container mt-5">
    <h2>Update Transaction</h2>
    <form method="post">
        <div class="form-group">
            <label>ID Pelanggan</label>
            <input type="text" name="idpelanggan" class="form-control" value="<?= $data['idpelanggan'] ?>" required>
        </div>
        <div class="form-group">
            <label>ID Karyawan</label>
            <input type="text" name="idkaryawan" class="form-control" value="<?= $data['idkaryawan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tgltransaksi" class="form-control" value="<?= $data['tgltransaksi'] ?>" required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategoripelanggan" class="form-control" value="<?= $data['kategoripelanggan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Total Bayar</label>
            <input type="number" name="totalbayar" class="form-control" value="<?= $data['totalbayar'] ?>" required>
        </div>
        <div class="form-group">
            <label>Bayar</label>
            <input type="number" name="bayar" class="form-control" value="<?= $data['bayar'] ?>" required>
        </div>
        <div class="form-group">
            <label>Kembali</label>
            <input type="number" name="kembali" class="form-control" value="<?= $data['kembali'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include "footer.php"; ?>