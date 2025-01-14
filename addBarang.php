<?php
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}
require 'functions.php';
$kategori = query("SELECT * FROM kategori");
if(isset($_POST['addBarangBtn']) == true){
    if (addBarang($_POST)>0) {
        echo "<script>alert('Tambah Barang berhasil ! ')
        document.location.href = 'barang.php';
        </script>";
    }else{
        echo "<script>alert('Tambah Barang gagal ! ')
        document.location.href = 'addBarang.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Tambah Barang </h2>
            <!-- Icon -->
            <div class="fadeIn first">
            <img src="https://blog.modalku.co.id/wp-content/uploads/2021/04/7_4_21-Tips-Mengelola-Stok-Barang-yang-Bisa-Kedaluwarsa.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="selectKategori" class="form-label">Kategori Barang</label>
                <select id="selectKategori" class="form-select" name="id_kategori">
                    <?php foreach($kategori as $k):?>
                    <option value="<?=$k['id']?>" ><?= $k['jenis']?> ( <?= $k['satuan']?> )</option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="text" id="kd_barang" class="fadeIn second" name="kd_barang" placeholder="Kode Barang">
            <input type="text" id="nm_barang" class="fadeIn second" name="nm_barang" placeholder="Nama Barang">
            <input type="text" id="hrg_barang" class="fadeIn second" name="hrg_barang" placeholder="Harga Barang">
            <input type="text" id="qty_barang" class="fadeIn second" name="qty_barang" placeholder="Quantity Barang">
            <input type="file" id="img_barang" class="fadeIn second" name="img_barang" placeholder="Image Barang">
            <input type="submit" class="fadeIn fourth" style="margin-top: 50px" value="Tambah Barang" name="addBarangBtn">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" href="barang.php"><< Kembali</a>
            </div>

        </div>
    </div>
    </div>
</body>
</html>