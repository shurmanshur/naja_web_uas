<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}

$id = $_GET['id'];
if (delKategori($id) > 0) {
    echo "<script>alert('Hapus kategori berhasil');
    document.location.href= 'kategori.php'; 
    </script>";
} else {

    echo "<script>
    alert('Hapus kategori gagal');
    document.location.href= 'kategori.php';
    </script>";
}
