<?php

include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $query = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES (NULL, $_POST[idpelanggan], $_POST[idkaryawan], '$_POST[tgl]', '$_POST[kategoripelanggan]', $_POST[totalbayar], $_POST[bayar], $_POST[kembali])");

    header("Location: transaksi.php");
}

include "header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <form action="inputTransaksi.php" method="post">
        <div class="mb-3">
            <label class="form-label">Nama pelanggan</label>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM tb_pelanggan");

            while ($data = mysqli_fetch_assoc($query)) {

            ?>
                <select class="form-control" name="idpelanggan">
                    <option value="<?= $data['idpelanggan'] ?>"><?= $data['namalengkap'] ?></option>
                </select>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama karyawan</label>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM tb_karyawan");

            while ($data = mysqli_fetch_assoc($query)) {

            ?>
                <select class="form-control" name="idkaryawan">
                    <option value="<?= $data['idkaryawan'] ?>"><?= $data['namakaryawan'] ?></option>
                </select>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori pelanggan</label>
            <input type="text" name="kategoripelanggan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tgl" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Total bayar</label>
            <input type="number" name="totalbayar" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Bayar</label>
            <input type="number" name="bayar" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Kembali</label>
            <input type="number" name="kembali" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php include "footer.php";
