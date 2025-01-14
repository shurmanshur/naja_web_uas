<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}

$id = $_GET['id'];
if (delBarang($id) > 0) {
    echo "<script>alert('Hapus barang berhasil');
    document.location.href= 'barang.php'; 
    </script>";
} else {

    echo "<script>
    alert('Hapus barang gagal');
    document.location.href= 'barang.php';
    </script>";
}
