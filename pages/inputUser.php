<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $leveluser = $_POST['leveluser'];
    $idkaryawan = $_POST['idkaryawan'];

    $query = mysqli_query($conn, "INSERT INTO tb_login (username, password, leveluser, idkaryawan) VALUES ('$username', '$password', '$leveluser', '$idkaryawan')");

    if ($query) {
        header('Location: user.php'); // Redirect to the user list page
        exit;
    } else {
        $error = "Failed to create user: " . mysqli_error($conn);
    }
}

include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
    <h2>Create User</h2>
    <form action="inputUser.php" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Level User</label>
            <input type="text" name="leveluser" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ID Karyawan</label>
            <input type="number" name="idkaryawan" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Create User</button>
    </form>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>

<?php include "../components/footer.php"; ?>