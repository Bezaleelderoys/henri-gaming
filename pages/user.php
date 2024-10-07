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
    <a href="inputUser.php" class="btn btn-primary mb-3">Create</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Level User</th>
                <th scope="col">ID Karyawan</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = mysqli_query($conn, "SELECT * FROM tb_login");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['password'] ?></td>
                    <td><?= $data['leveluser'] ?></td>
                    <td><?= $data['idkaryawan'] ?></td>
                    <td><a href="updateUser.php?id=<?= $data['username'] ?>" class="btn btn-warning">Update</a></td>
                    <td><a href="deleteUser.php?id=<?= $data['username'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pelanggan?');">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "../components/footer.php";
