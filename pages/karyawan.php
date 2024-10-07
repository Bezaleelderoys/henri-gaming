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
    <a href="inputKaryawan.php" class="btn btn-primary mb-3">Create</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">ID karyawan</th>
                <th scope="col">nama</th>
                <th scope="col">alamat</th>
                <th scope="col">telp </th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM tb_karyawan");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $data['idkaryawan'] ?></td>
                    <td><?= $data['namakaryawan'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['telp'] ?></td>
                    <td><a href="updateKaryawan.php?id=<?= $data['idkaryawan'] ?>" class="btn btn-warning">Update</a></td>
                    <td><a href="deleteKaryawan.php?id=<?= $data['idkaryawan'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this karyawan?');">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "../components/footer.php";
