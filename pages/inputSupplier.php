<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $perusahaan = $_POST['perusahaan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($conn, "INSERT INTO tb_supplier (perusahaan, telp, alamat, keterangan) VALUES ('$perusahaan', '$telp', '$alamat', '$keterangan')");

    if ($query) {
        header('Location: supplier.php'); // Redirect to the supplier list page
        exit;
    } else {
        $error = "Failed to create supplier: " . mysqli_error($conn);
    }
}

include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <h2>Create Supplier</h2>
    <form action="inputSupplier.php" method="post">
        <div class="mb-3">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Create Supplier</button>
    </form>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>

<?php include "../components/footer.php"; ?>