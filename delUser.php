<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}
$id = $_GET['id'];
if (delUser($id) > 0) {
    echo "<script>alert('Hapus user berhasil');
    document.location.href= 'user.php'; 
    </script>";
} else {

    echo "<script>
    alert('Hapus user gagal');
    document.location.href= 'user.php';
    </script>";
}
