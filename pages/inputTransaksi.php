<?php

include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$idtransaksi = null; // Initialize the variable

if (isset($_POST['submit'])) {
    $idpelanggan = $_POST['idpelanggan'];
    $idkaryawan = $_POST['idkaryawan'];
    $tgl = $_POST['tgl'];
    $kategoripelanggan = $_POST['kategoripelanggan'];

    $query = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES (NULL, $idpelanggan, $idkaryawan, '$tgl', '$kategoripelanggan', NULL, NULL, NULL)");

    // Check for errors
    if (!$query) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Get the last inserted transaction ID
    $idtransaksi = mysqli_insert_id($conn);
}

if (isset($_POST['tambah'])) {
    $idtransaksi = $_POST['idtransaksi']; // Get the transaction ID from the POST request
    $idobat = $_POST['idobat'];
    $jumlah = $_POST['jumlah'];

    $cari_obat = mysqli_query($conn, "SELECT hargajual FROM tb_obat WHERE id_obat = $idobat");

    // Check for errors
    if (!$cari_obat) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $fetch_harga_obat = mysqli_fetch_array($cari_obat);
    $hargaObat = $fetch_harga_obat['hargajual'];
    $jumlahHarga = $hargaObat * $jumlah;

    $query = mysqli_query($conn, "INSERT INTO tb_detail_transaksi VALUES (NULL, $idtransaksi, $idobat, $jumlah, $hargaObat, $jumlahHarga)");

    // Check for errors
    if (!$query) {
        die("Error executing query: " . mysqli_error($conn));
    }
}
if (isset($_POST['pay'])) {
    $idtransaksi = $_POST['idtransaksi'];
    $totalBayar = $_POST['totalbayar'];
    $kembali = $_POST['bayar'] - $totalBayar;

    $query = mysqli_query($conn, "UPDATE tb_transaksi SET totalbayar = $totalBayar, bayar = $_POST[bayar], kembali = $kembali WHERE idtransaksi = $idtransaksi");
    header("Location: transaksi.php");
}
include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <?php
    if (!isset($_POST['submit']) && !isset($_POST['tambah'])) {
    ?>
        <form action="inputTransaksi.php" method="post">
            <div class="mb-3">
                <label class="form-label">Nama pelanggan</label>
                <select class="form-control" name="idpelanggan">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
                    if (!$query) {
                        die("Error executing query: " . mysqli_error($conn));
                    }
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $data['idpelanggan'] ?>"><?= $data['namalengkap'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama karyawan</label>
                <select class="form-control" name="idkaryawan">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM tb_karyawan");
                    if (!$query) {
                        die("Error executing query: " . mysqli_error($conn));
                    }
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $data['idkaryawan'] ?>"><?= $data['namakaryawan'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori pelanggan</label>
                <input type="text" name="kategoripelanggan" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tgl" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php
    } else {
        if ($idtransaksi === null) {
            $query = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY idtransaksi DESC LIMIT 1");
            if (!$query) {
                die("Error executing query: " . mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($query);
            $idtransaksi = $row['idtransaksi']; // Set the transaction ID here
        }
    ?>
        <div class="row">
            <div class="col-sm-6">
                <form action="inputTransaksi.php" method="post">
                    <input type="number" name="idtransaksi" value="<?= $idtransaksi ?>" hidden>
                    <label class="form-label">Nama barang</label>
                    <select name="idobat" class="form-control">
                        <?php
                        $obat = mysqli_query($conn, "SELECT * FROM tb_obat");
                        if (!$obat) {
                            die("Error executing query: " . mysqli_error($conn));
                        }
                        while ($row = mysqli_fetch_array($obat)) {
                        ?>
                            <option value="<?= $row['id_obat'] ?>"><?= $row['namaobat'] ?></option>
                        <?php } ?>
                    </select>
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control">
                    <input type="submit" value="Tambah" name="tambah" class="mt-3 btn btn-primary">
                </form>
            </div>
            <div class="col-sm-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nama obat</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga satuan</th>
                            <th scope="col">Total harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($idtransaksi !== null) {
                            $query = mysqli_query($conn, "SELECT tb_detail_transaksi.*, tb_obat.namaobat FROM tb_detail_transaksi INNER JOIN tb_obat ON tb_detail_transaksi.idobat = tb_obat.id_obat WHERE idtransaksi = $idtransaksi");
                            if (!$query) {
                                die("Error executing query: " . mysqli_error($conn));
                            }
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $row['namaobat'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['hargasatuan'] ?></td>
                                    <td><?= $row['totalharga'] ?></td>
                                </tr>
                        <?php }
                        }

                        $query = mysqli_query($conn, "SELECT SUM(totalharga) FROM tb_detail_transaksi WHERE idtransaksi = $idtransaksi");
                        $fetch = mysqli_fetch_assoc($query);

                        ?>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><?= $fetch['SUM(totalharga)'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php



                ?>
                <form action="inputTransaksi.php" method="post">
                    <label>Bayar</label>
                    <input type="number" name="idtransaksi" value="<?= $idtransaksi ?>" hidden>
                    <input type="number" name="totalbayar" value="<?= $fetch['SUM(totalharga)'] ?>" class="form-control" hidden>
                    <input type="number" name="bayar" class="form-control">
                    <button type="submit" name="pay" class="mt-3 btn btn-success">Bayar</button>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php include "../components/footer.php"; ?>