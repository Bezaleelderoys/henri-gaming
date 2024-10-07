<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $deleteQuery = "DELETE FROM tb_pelanggan WHERE idpelanggan='$id'";

    if (mysqli_query($conn, $deleteQuery)) {
        header('Location: pelanggan.php'); // Redirect back to the main page
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    die("Invalid request!");
}
