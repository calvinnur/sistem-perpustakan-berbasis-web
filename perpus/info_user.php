<?php
require_once('library.php');
$call = new perpus;
$id = $_GET['id'];
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
                <?php foreach($call->data_user() as $key => $value) : ?>
            <li style="margin-top: 10px; position:relative; top:-10px; left:0px;"><i class="fas fa-info-circle" style="position: absolute; left:-22px;"></i><a href="info_user.php?id=<?php echo $value['id']?>">Info saya</a></li>
                <li style="position: relative; left:20px;"><i class="fas fa-wrench" style="position: absolute; left:-25px;"></i> <a href="setting_user.php?id=<?php echo $value['id']?>">Pengaturan</a> </li>
                <?php endforeach?>
                <li style="margin-top: 10px; position:relative; left:-15px;"> <i class="fas fa-sign-out-alt" style="position: absolute; left:-25px;" ></i><a href="logout.php"> Keluar</a></li>
            </ul>
        </div>
    </div>
    <!-- end of navbar -->

    <!-- start of sidebar -->
    <div class="sidebar">
    <h2 style="color: white; text-align:center;"><i class="fas fa-book-open" style="color: white;"></i> Member </h2>  
    <div class="garis" style="margin-top: -9px;"></div>
    <h3><i class="fas fa-window-restore" style=" margin-right:10px;"></i> <a href="dashboard.php">Semua buku</a> </h3>
    <div class="garis" style="margin-top: -9px;"></div>
    <h3><i class="fas fa-book-reader"  style=" margin-right:10px;"></i> <a href="template_mem.php?page=pinjaman">Pinjaman Saya</a> </h3>
    <div class="garis" style="margin-top: -9px;"></div>
    <h3> <i class="far fa-calendar-times"  style=" margin-right:10px;"></i> <a href="template_mem.php?page=status">Status Pinjaman</a> </h3>
    <div class="garis" style="margin-top: -9px;"></div>
    <h3> <i class="far fa-comment-dots" style=" margin-right:10px;"></i> <a href="template_mem.php?page=komplain">Komplain</a> </h3>
    <div class="garis" style="margin-top: -9px;"></div>
    <h3> <i class="far fa-hand-point-left"  style=" margin-right:10px;"></i> <a href="template_mem.php?page=pengembalian">pengembalian</a> </h3>
    <div class="garis" style="margin-top: -9px;"></div>
    <div class="copyright" style="padding: 60%;"></div>
     <p style="color: white; font-size:14px; text-align:center;">Copyright My Website 2021</p>
    </div>
    <!-- end of sidebar -->

    <!-- insert book menu -->
    <div class="insert-book">
        <div class="form-insert" style="width: 400px; height:310px;">
                    <h1 style="color: blue;">Info saya</h1>
                    <?php foreach($call->user_setting($id) as $key => $value):?>
                    <h3 style="margin-left: 50px;">Nama : <span style="font-size: 16px; margin-left:10px;"><?php echo $value['username']?></span></h3>
                    <h3 style="margin-left: 50px;">No telp : <span style="font-size: 16px; margin-left:10px;"><?php echo $value['phone_number']?></span></h3>
                    <h3 style="margin-left: 50px;">Alamat : <span style="font-size: 16px; margin-left:10px;"><?php echo $value['address']?></span></h3>
                    <?php endforeach?>
            <button type="submit" class="submit" style="margin-left: 80px; margin-top:30px;"><a href="dashboard.php?page=dashboard" style="text-decoration: none; color:white;">Kembali</a></button>
        </div>

    </div>
    <script src="index.js"></script>
    <script src="../../jquery.js"></script>
</body>

</html>