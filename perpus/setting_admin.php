<?php
require_once('library.php');
    if(!isset($_SESSION['username'])){
        header('location:index.php');
    }
    $id = $_GET['id'];
    $call = new perpus;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../perpus/css/all.min.css">
    <link rel="stylesheet" href="index.css?<?php echo time() ?>">
    <title>Document</title>
</head>
<body style="background-color: #e8eced;">
    <!-- start of navbar -->
    <div class="navbar">
        <ul>
            <li style="margin-right:20px; cursor:pointer;"><i class="fas fa-cog" style="color:black;" onclick="show_setting()"></i></li>
            <li style="position:relative; left:35px; color: black;"><?php echo $_SESSION['username']; ?></li>
            <?php foreach($call->data_user() as $key => $value) :?>
            <li style="position:relative; left:70px; color: black; top:-10px;"><img src="<?php echo $value['profile_pict']?>" class="profile"></li>
            <?php endforeach?>
        </ul>
        <div class="user-setting" id="target">
        <ul>
                <?php foreach ($call->data_user() as $key => $value) : ?>
                    <li style="margin-top: 10px; position:relative; top:-10px; left:5px;"><i class="fas fa-info-circle" style="position: absolute; left:-22px;"></i><a href="info_admin.php?id=<?php echo $value['id'] ?>">Info saya</a></li>
                    <li style="position: relative; left:25px;"><i class="fas fa-wrench" style="position: absolute; left:-25px;"></i> <a href="setting_admin.php?id=<?php echo $value['id'] ?>">Pengaturan</a> </li>
                <?php endforeach ?>
                <li style="margin-top: 10px; position: relative; left:-10px;"> <i class="fas fa-sign-out-alt" style="position: relative; left:-5px;"></i> <a href="logout.php"> Keluar</a></li>
            </ul>
        </div>
        </div>
    </div>
    <!-- end of navbar -->

    <!-- start of sidebar -->
    <div class="sidebar">
        <h2 style="color: white; text-align:center;"><i class="fas fa-user"></i> Admin </h2>
        <div class="garis" style="margin-top: -9px;"></div>
        <h3><i class="fas fa-tachometer-alt" style="color: white; margin-right:10px;"></i><a href="admin.php?page=dashboard">Dashboard</a></h3>
        <div class="garis"></div>
        <h3><i class="fas fa-book-medical" style="color: white; margin-right:10px;"></i> <a href="admin.php?page=insert">Tambah buku</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-swatchbook" style=" margin-right:10px;"></i> <a href="total.php">Total buku</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-window-restore" style=" margin-right:10px;"></i> <a href="total.php">Daftar pinjaman</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-users" style=" margin-right:10px;"></i> <a href="allmember.php">Daftar Member</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-exclamation" style=" margin-right:10px;"></i><a href="admin.php?page=complain">Daftar complain</a> </h3>
        <div class="garis"></div>
        <h3><i class="far fa-hand-point-left"  style=" margin-right:10px;"></i><a href="admin.php?page=pengembalianbuku">Pengembalian</a> </h3>
        <div class="garis"></div>
        <div class="copyright"></div>
        <p style="color: white; font-size:14px; text-align:center;">Copyright My Website 2021</p>
    </div>
    <!-- end of sidebar -->

    <!-- start of setting -->
    <div class="insert-book">
            <form method="POST" action="settingadm_proses.php" enctype="multipart/form-data" >
                <div class="form-insert" style="height: 420px;">
                    <h1 style="color: blue; ">Pengaturan</h1><br>
                    <?php foreach($call->user_setting($id) as $key => $value) :?>
                    <input type="hidden" name="id" value="<?php echo $value['id']?>">
                    <input type="file" name="file" id="file" style="display: none;">
                    <img src="<?php echo $value['profile_pict']?>" class="user-image"><button type="button" style="position: absolute; right:550px; top:220px; cursor:pointer; border:0px #ffffff solid;" onclick="$('#file').click()"><i class="fas fa-camera"  ></button></i>
                    <label style=" position: relative; left: 10px;">No telp</label><br><br>
        <input type="text" name="phone_number" placeholder="Phone Number" required value="<?php echo $value['phone_number']?>"><br><br>
        <label style=" position: relative; left: 100px;">Alamat</label><br><br>
        <input type="text" name="address" placeholder=" your address" required value="<?php echo $value['address']?>"><br><br>
        <?php endforeach?>
        
         <button type="submit" class="submit">Ubah</button>
        </div>
        </form>
    </div>
<script src="index.js"></script>
<script src="../../jquery.js"></script>
</body>
</html>