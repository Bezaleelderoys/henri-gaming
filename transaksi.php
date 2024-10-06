<?php

include "conn.php";

session_start();
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}


include "header.php";
?>


<div class="container-fluid mt-5 pb-5">
  <a href="inputTransaksi.php" class="btn btn-primary mb-3">Create</a>
  <table class="table table-striped">
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
        <th>Update</th>
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
          <td><a href="updateTransaksi.php?id=<?= $data['idtransaksi'] ?>" class="btn btn-warning">Update</a></td>
          <td><a href="deleteTransaksi.php?id=<?= $data['idtransaksi'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?');">Delete</a></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include "footer.php";
