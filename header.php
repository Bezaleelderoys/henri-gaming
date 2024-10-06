<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand  text-white" href="index.php">Apotek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="karyawan.php">Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="obat.php">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="pelanggan.php">Pelanggan</a>
                    </li>
                    <?php

                    if (isset($_SESSION)) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="logout.php">Logout</a>
                        </li>
                    <?php
                    }


                    ?>
                </ul>
                <?php

                if (isset($_SESSION)) {
                ?>

                    <a class="nav-link disabled text-white"><?= $_SESSION['username'] ?></a>
                <?php
                }


                ?>
            </div>
        </div>
    </nav>