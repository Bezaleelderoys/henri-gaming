<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE idkaryawan='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Karyawan not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namakaryawan = $_POST['namakaryawan'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $updateQuery = "UPDATE tb_karyawan SET 
        namakaryawan='$namakaryawan', 
        alamat='$alamat', 
        telp='$telp' 
        WHERE idkaryawan='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: karyawan.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<?php include "header.php"; ?>
<div class="container mt-5">
    <h2>Update Karyawan</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama Karyawan</label>
            <input type="text" name="namakaryawan" class="form-control" value="<?= $data['namakaryawan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" class="form-control" value="<?= $data['telp'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include "footer.php"; ?>