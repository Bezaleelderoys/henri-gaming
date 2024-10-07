<?php
include "conn.php"; // Include the database connection

session_start();
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

include "../components/header.php";

// Query to get the count of rows from each table
$obatCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tb_obat");
$obatCount = mysqli_fetch_assoc($obatCountQuery)['count'];

$karyawanCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tb_karyawan");
$karyawanCount = mysqli_fetch_assoc($karyawanCountQuery)['count'];

$pelangganCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tb_pelanggan");
$pelangganCount = mysqli_fetch_assoc($pelangganCountQuery)['count'];

$transaksiCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tb_transaksi");
$transaksiCount = mysqli_fetch_assoc($transaksiCountQuery)['count'];
?>

<div class="container-fluid mt-5 pb-5">
  <div class="row">
    <div class="col-sm-6 mt-3">
      <div class="card">
        <div class="card-body">
          <h1><?= $obatCount ?></h1>
          <p>Jumlah Obat</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 mt-3">
      <div class="card">
        <div class="card-body">
          <h1><?= $karyawanCount ?></h1>
          <p>Jumlah Karyawan</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 mt-3">
      <div class="card">
        <div class="card-body">
          <h1><?= $pelangganCount ?></h1>
          <p>Jumlah Pelanggan</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 mt-3">
      <div class="card">
        <div class="card-body">
          <h1><?= $transaksiCount ?></h1>
          <p>Jumlah Transaksi</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "../components/footer.php"; ?>