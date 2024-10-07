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
  <a href="inputTransaksi.php" class="btn btn-primary mb-3">Create</a>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col">ID transaksi</th>
        <th scope="col">ID pelanggan</th>
        <th scope="col">ID karyawan</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Kategori</th>
        <th scope="col">Total bayar</th>
        <th scope="col">Bayar</th>
        <th scope="col">Kembali</th>
        <th>Detail</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = mysqli_query($conn, "SELECT * FROM tb_transaksi");

      while ($data = mysqli_fetch_assoc($query)) {
      ?>
        <tr>
          <td><?= $data['idtransaksi'] ?></td>
          <td><?= $data['idpelanggan'] ?></td>
          <td><?= $data['idkaryawan'] ?></td>
          <td><?= $data['tgltransaksi'] ?></td>
          <td><?= $data['kategoripelanggan'] ?></td>
          <td><?= $data['totalbayar'] ?></td>
          <td><?= $data['bayar'] ?></td>
          <td><?= $data['kembali'] ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $data['idtransaksi'] ?>">
              View Details
            </button>
          </td>
          <td><a href="deleteTransaksi.php?id=<?= $data['idtransaksi'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="modal<?= $data['idtransaksi'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $data['idtransaksi'] ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel<?= $data['idtransaksi'] ?>">Transaction Details (ID: <?= $data['idtransaksi'] ?>)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><strong>ID Pelanggan:</strong> <?= $data['idpelanggan'] ?></p>
                <p><strong>ID Karyawan:</strong> <?= $data['idkaryawan'] ?></p>
                <p><strong>Tanggal:</strong> <?= $data['tgltransaksi'] ?></p>
                <p><strong>Kategori:</strong> <?= $data['kategoripelanggan'] ?></p>
                <p><strong>Total Bayar:</strong> <?= $data['totalbayar'] ?></p>
                <p><strong>Bayar:</strong> <?= $data['bayar'] ?></p>
                <p><strong>Kembali:</strong> <?= $data['kembali'] ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include "../components/footer.php"; ?>