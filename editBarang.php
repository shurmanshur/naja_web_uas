<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}
$id= $_GET['id'];
$barang = query("SELECT * FROM barang WHERE id=$id");
$kategori = query("SELECT * FROM kategori");
if(isset($_POST['updateBarangBtn']) == true){
    if (updateBarang($_POST)>0) {
        echo "<script>alert('Update Barang berhasil ! ')
        document.location.href = 'barang.php';
        </script>";
        // $_SESSION['username'] = $_POST['username'];
        // $_SESSION['password'] = $_POST['password'];
    }else{
        echo "<script>alert('Update Barang gagal ! ')
        document.location.href = 'editBarang.php';
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
            <h2 class="active"> Edit Barang </h2>
            <?php foreach($barang as $b):?>
            <!-- Icon -->
            <div class="fadeIn first">
            <img src="img_barang/<?=$b['img_barang']?>" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="selectKategori" class="form-label">Kategori Barang</label>
                <select id="selectKategori" class="form-select" name="id_kategori">
                    <?php foreach($kategori as $k):?>
                    <option value="<?=$k['id']?>" <?php if($k['id'] == $b['id_kategori']):?>selected<?php endif; ?> ><?= $k['jenis']?> ( <?= $k['satuan']?> )</option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="hidden" id="id" class="fadeIn second" value="<?=$b['id']?>" name="id">
            <input type="text" id="kd_barang" class="fadeIn second" value="<?=$b['kd_barang']?>" name="kd_barang" placeholder="Kode Barang">
            <input type="text" id="nm_barang" class="fadeIn second" value="<?=$b['nm_barang']?>"name="nm_barang" placeholder="Nama Barang">
            <input type="text" id="hrg_barang" class="fadeIn second" value="<?=$b['hrg_barang']?>" name="hrg_barang" placeholder="Harga Barang">
            <input type="text" id="qty_barang" class="fadeIn second" value="<?=$b['qty_barang']?>" name="qty_barang" placeholder="Quantity Barang">
            <input type="file" id="img_barang" class="fadeIn second" name="img_barang" placeholder="Image Barang">
            <input type="hidden" id="old_img_barang" class="fadeIn second" value="<?=$b['img_barang']?>"name="old_img_barang" placeholder="Image Barang">
            <h6>Kosongkan gambar jika tidak ingin diubah</h6>
            <input type="submit" class="fadeIn fourth" style="margin-top: 50px" value="Update Barang" name="updateBarangBtn">
            </form>
            <?php endforeach;?>

            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" href="barang.php"><< Kembali</a>
            </div>

        </div>
    </div>
    </div>
</body>
</html>