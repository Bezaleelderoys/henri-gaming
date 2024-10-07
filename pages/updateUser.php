<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$username = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM tb_login WHERE username = '$username'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $password = $_POST['password'];
    $leveluser = $_POST['leveluser'];
    $idkaryawan = $_POST['idkaryawan'];

    $updateQuery = mysqli_query($conn, "UPDATE tb_login SET password = '$password', leveluser = '$leveluser', idkaryawan = '$idkaryawan' WHERE username = '$username'");

    if ($updateQuery) {
        header('Location: user.php'); // Redirect to the user list page
        exit;
    } else {
        $error = "Failed to update user: " . mysqli_error($conn);
    }
}

include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <h2>Update User</h2>
    <form action="updateUser.php?id=<?= $username ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" value="<?= $data['password'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Level User</label>
            <input type="text" name="leveluser" class="form-control" value="<?= $data['leveluser'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ID Karyawan</label>
            <input type="number" name="idkaryawan" class="form-control" value="<?= $data['idkaryawan'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update User</button>
    </form>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>

<?php include "../components/footer.php"; ?>