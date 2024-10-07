<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namakaryawan = $_POST['namakaryawan'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $insertQuery = "INSERT INTO tb_karyawan (namakaryawan, alamat, telp) VALUES ('$namakaryawan', '$alamat', '$telp')";

    if (mysqli_query($conn, $insertQuery)) {
        header('Location: karyawan.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "../components/header.php"; ?>
<div class="container mt-5">
    <h2>Create Karyawan</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama Karyawan</label>
            <input type="text" name="namakaryawan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?php include "../components/footer.php"; ?>