<?php
require 'functions.php';
session_start();
if (!$_SESSION['username']) {
    echo "<script>alert('Silahkan login !');
        document.location.href= 'login.php';; 
        </script> ";
}
$data = query("SELECT * FROM user");

if(isset($_POST['updateUserBtn']) == true){
    if (updateUser($_POST)>0) {
        echo "<script>alert('Update User berhasil ! ')
        document.location.href = 'user.php';
        </script>";
        // $_SESSION['username'] = $_POST['username'];
        // $_SESSION['password'] = $_POST['password'];
    }else{
        echo "<script>alert('Update User gagal ! ')
        document.location.href = 'user.php';
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
                <a class="nav-link active" href="user.php">User</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="kategori.php">Kategori</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="barang.php">Barang</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a style="color:red" href="logout.php">Logout</a>
            </span>
            </div>
        </div>
    </nav>

    <p class="fs-2 mt-5">Halaman User</p>
    <a href="register.php" class="btn btn-info my-3" >Registrasi User</a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Mobile</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=0;
            foreach($data as $d):?>
            <tr>
            <th scope="row"><?= ++$i ?></th>
            <td><?= $d['username'] ?></td>
            <td><?= $d['mobile'] ?></td>
            <td>
                <a href="delUser.php?id=<?=$d['id']?>" class="btn btn-danger">Hapus Akun</a>
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser<?=$d['id']?>" >Edit Profil</a>
                    <!-- Modal -->
                    <div class="modal fade" id="editUser<?=$d['id']?>" tabindex="-1" aria-labelledby="editUser<?=$d['id']?>Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editUser<?=$d['id']?>Label">Tambah Kategori</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" value="<?=$d['id']?>" class="form-control" id="id" name="id">
                                        <input type="hidden" value="<?=$d['password']?>" class="form-control" id="old_password" name="old_password">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" value="<?=$d['username']?>" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input type="text" value="<?=$d['mobile']?>" class="form-control" id="mobile" name="mobile">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="hanya diisi jika ingin diubah">
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="updateUserBtn">Kirim</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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