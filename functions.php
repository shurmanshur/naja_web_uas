<?php
$conn = mysqli_connect("localhost", "root", "root", "naja_uas");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addUser($post)
{
    global $conn;
    $username = $post['username'];
    $katasandi = password_hash($post['password'], PASSWORD_DEFAULT);
    $mobile = $post['mobile'];
    $query = "INSERT INTO user (username, password, mobile)  VALUES ('$username', '$katasandi', '$mobile')";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result == 0) {
        echo mysqli_error_list($conn);
    }
    return $result;
}

function addKategori($post)
{
    global $conn;
    $jenis = $post['jenis'];
    $satuan = $post['satuan'];
    $query = "INSERT INTO kategori (jenis, satuan) VALUES ('$jenis', '$satuan')";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result == 0) {
        echo mysqli_error_list($conn);
    }
    return $result;
}

function addBarang($post)
{
    global $conn;
    $kd_barang = $post['kd_barang'];
    $nm_barang = $post['nm_barang'];
    $qty_barang = $post['qty_barang'];
    $id_kategori = $post['id_kategori'];
    $hrg_barang = $post['hrg_barang'];
    $img_barang = upload('img_barang','img_barang/');
    if (!$img_barang) {
        echo "<script>alert('Data upload gagal !')</script>";
        return false;
    }
    $query = "INSERT INTO barang (kd_barang, nm_barang, qty_barang, id_kategori, hrg_barang, img_barang)  VALUES ('$kd_barang','$nm_barang', $qty_barang,$id_kategori, $hrg_barang, '$img_barang')";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result == 0) {
        echo mysqli_error_list($conn);
    }
    return $result;
}

function upload($file,$path)
{
    global $conn;
    $name = $_FILES[$file]['name'];
    $size = $_FILES[$file]['size'];
    $error = $_FILES[$file]['error'];
    $tmp_name = $_FILES[$file]['tmp_name'];

    if ($error == 4) {
        echo "<scripta>alert('Data upload kosong !')</script>";
        return false;
    }
    if ($size > 500000) {
        echo "<scripta>alert('Data upload terlalu besar !')</script>";
        return false;
    }
    move_uploaded_file($tmp_name, $path . $name);
    return $name;
}

function delUser($id)
{
    global $conn;
    $query = "DELETE FROM user WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delKategori($id)
{
    global $conn;
    $query = "DELETE FROM kategori WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delBarang($id)
{
    global $conn;
    $query = "DELETE FROM barang WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateUser($post)
{
    global $conn;
    $id = $post['id'];
    $username = $post['username'];
    $mobileNumber = $post['mobile'];
    $katasandi = '';


    //cek password
    if ($post['password'] == null) {
        $katasandi = $post['old_password'];
    } else {
        $katasandi = password_hash($post['password'], PASSWORD_DEFAULT);
    }


    $query = "UPDATE user SET username = '$username', password = '$katasandi', mobile = '$mobileNumber' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateKategori($post)
{
    global $conn;
    $id = $post['id'];
    $jenis = $post['jenis'];
    $satuan = $post['satuan'];

    $query = "UPDATE kategori SET jenis = '$jenis', satuan = '$satuan' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateBarang($post)
{
    global $conn;
    $id = $post['id'];
    $kd_barang = $post['kd_barang'];
    $nm_barang = $post['nm_barang'];
    $qty_barang = $post['qty_barang'];
    $hrg_barang = $post['hrg_barang'];
    $img_barang = '';
    if ($_FILES['img_barang']['error'] == 4) {
        $img_barang = $post['old_img_barang'];
    } else {
        $img_barang = upload();
        if (!$img_barang) {
            echo "<script>alert('Data upload gagal !')</script>";
            return false;
        }
    }

    $query = "UPDATE barang SET kd_barang = '$kd_barang', nm_barang = '$nm_barang',  hrg_barang = $hrg_barang, qty_barang = $qty_barang, img_barang = '$img_barang' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function login($post)
{
    $username = $post['username'];
    $password = $post['password'];
    $passSaved = '';

    $data = query("SELECT * FROM user WHERE username = '$username'");
    if ($data == []) {
        echo "<script>alert('Identitas belum terdaftar!')
        document.location.href = 'login.php';
        </script>";
        return false;
    }

    foreach ($data as $m) {
        $passSaved = $m['password'];
    }

    if (!password_verify($password, $passSaved)) {
        echo "<script>alert('Password Salah !')
        document.location.href = 'login.php';
        </script>";
        return false;
    }

    return true;
}
