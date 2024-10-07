<?php

include "conn.php";

session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}


include "../components/header.php";
?>


<div class="container-fluid mt-5 pb-5">
    <a href="inputObat.php" class="btn btn-primary mb-3">Create</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">ID obat</th>
                <th scope="col">Supplier</th>
                <th scope="col">nama obat</th>
                <th scope="col">kategori obat</th>
                <th scope="col">harga jual</th>
                <th scope="col">harga beli</th>
                <th scope="col">stok</th>
                <th scope="col">KETERANGAN</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM tb_obat");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $data['id_obat'] ?></td>
                    <td><?= $data['id_supplier'] ?></td>
                    <td><?= $data['namaobat'] ?></td>
                    <td><?= $data['kategoriobat'] ?></td>
                    <td><?= $data['hargajual'] ?></td>
                    <td><?= $data['hargabeli'] ?></td>
                    <td><?= $data['stok_obat'] ?></td>
                    <td><?= $data['keterangan'] ?></td>
                    <td><a href="updateObat.php?id=<?= $data['id_obat'] ?>" class="btn btn-warning">Update</a></td>
                    <td><a href="deleteObat.php?id=<?= $data['id_obat'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this obat?');">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "../components/footer.php";
