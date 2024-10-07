<?php
include "conn.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$id_supplier = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tb_supplier WHERE id_supplier = '$id_supplier'");

if ($query) {
    header('Location: supplier.php'); // Redirect to the supplier list page
    exit;
} else {
    die("Failed to delete supplier: " . mysqli_error($conn));
}
