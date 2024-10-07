<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE idpelanggan='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Pelanggan not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $usia = $_POST['usia'];
    $buktifotoresep = $_POST['buktifotoresep'];

    $updateQuery = "UPDATE tb_pelanggan SET 
        namalengkap='$namalengkap', 
        alamat='$alamat', 
        telp='$telp', 
        usia='$usia', 
        buktifotoresep='$buktifotoresep' 
        WHERE idpelanggan='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: pelanggan.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<?php include "../components/header.php"; ?>
<div class="container mt-5">
    <h2>Update Pelanggan</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="namalengkap" class="form-control" value="<?= $data['namalengkap'] ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" class="form-control" value="<?= $data['telp'] ?>" required>
        </div>
        <div class="form-group">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" value="<?= $data['usia'] ?>" required>
        </div>
        <div class="form-group">
            <label>Bukti Foto Resep</label>
            <input type="text" name="buktifotoresep" class="form-control" value="<?= $data['buktifotoresep'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include "../components/footer.php"; ?>