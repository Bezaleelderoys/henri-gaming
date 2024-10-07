<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$username = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tb_login WHERE username = '$username'");

if ($query) {
    header('Location: user.php'); // Redirect to the user list page
    exit;
} else {
    die("Failed to delete user: " . mysqli_error($conn));
}
