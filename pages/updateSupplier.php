<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$id_supplier = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM tb_supplier WHERE id_supplier = '$id_supplier'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $perusahaan = $_POST['perusahaan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];

    $updateQuery = mysqli_query($conn, "UPDATE tb_supplier SET perusahaan = '$perusahaan', telp = '$telp', alamat = '$alamat', keterangan = '$keterangan' WHERE id_supplier = '$id_supplier'");

    if ($updateQuery) {
        header('Location: supplier.php'); // Redirect to the supplier list page
        exit;
    } else {
        $error = "Failed to update supplier: " . mysqli_error($conn);
    }
}

include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <h2>Update Supplier</h2>
    <form action="updateSupplier.php?id=<?= $id_supplier ?>" method="post">
        <div class="mb-3">
            <label class="form-label">ID Supplier</label>
            <input type="text" name="id_supplier" class="form-control" value="<?= $data['id_supplier'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" value="<?= $data['perusahaan'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control" value="<?= $data['telp'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="<?= $data['keterangan'] ?>">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Supplier</button>
    </form>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>

<?php include "../components/footer.php"; ?>