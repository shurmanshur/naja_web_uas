<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}

$query = mysqli_query($conn, "SELECT barang.*, kategori.jenis, kategori.satuan FROM barang, kategori WHERE barang.id_kategori = kategori.id");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
// var_dump($data);
// die;

if(isset($_POST['addKategoriBtn']) == true){
    if (addKategori($_POST)>0) {
        echo "<script>alert('Tambah Kategori berhasil ! ')
        document.location.href = 'kategori.php';
        </script>";
        // $_SESSION['username'] = $_POST['username'];
        // $_SESSION['password'] = $_POST['password'];
    }else{
        echo "<script>alert('Tambah Kategori gagal ! ')
        document.location.href = 'kategori.php';
        </script>";
    }
}

if(isset($_POST['updateKategoriBtn']) == true){
    if (updateKategori($_POST)>0) {
        echo "<script>alert('Update Kategori berhasil ! ')
        document.location.href = 'kategori.php';
        </script>";
        // $_SESSION['username'] = $_POST['username'];
        // $_SESSION['password'] = $_POST['password'];
    }else{
        echo "<script>alert('Update Kategori gagal ! ')
        document.location.href = 'kategori.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naja UAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" style="color:blue" href="#">Naja UAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="user.php">User</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="kategori.php">Kategori</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="barang.php">Barang</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a style="color:red" href="logout.php">Logout</a>
            </span>
            </div>
        </div>
    </nav>

    <p class="fs-2 mt-5">Halaman Barang</p>
    <a href="addBarang.php" class="btn btn-info my-3" >Tambah Barang</a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Img</th>
            <th scope="col">Kode</th>
            <th scope="col">Kategori</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=0;
            foreach($data as $d):?>
            <tr>
            <th scope="row"><?= ++$i ?></th>
            <td>
                <img width="50px" src="img_barang/<?= $d['img_barang'] ?>" alt="">
            </td>
            <td><?= $d['kd_barang'] ?></td>
            <td><?= $d['jenis'] ?></td>
            <td><?= $d['nm_barang'] ?></td>
            <td><?= $d['qty_barang'] ?></td>
            <td><?= $d['satuan'] ?></td>
            <td><?= $d['hrg_barang'] ?></td>
            <td>
                <a href="delBarang.php?id=<?=$d['id']?>" class="btn btn-danger">Hapus</a>
                <a href="editBarang.php?id=<?=$d['id']?>" class="btn btn-primary" >Edit</a>
            </td>
            </tr>
            <?php endforeach;?>

        </tbody>
    </table>


    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>