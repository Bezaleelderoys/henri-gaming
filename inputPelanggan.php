<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $usia = $_POST['usia'];
    $buktifotoresep = $_POST['buktifotoresep'];

    $insertQuery = "INSERT INTO tb_pelanggan (namalengkap, alamat, telp, usia, buktifotoresep) VALUES ('$namalengkap', '$alamat', '$telp', '$usia', '$buktifotoresep')";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: pelanggan.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "header.php"; ?>
<div class="container mt-5">
    <h2>Create Pelanggan</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="namalengkap" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Bukti Foto Resep</label>
            <input type="text" name="buktifotoresep" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?php include "footer.php"; ?>