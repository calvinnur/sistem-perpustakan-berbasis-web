<?php
require_once('library.php');
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$call = new perpus;
$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
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

<body>
    <!-- start of navbar -->
    <div class="navbar">
        <ul>
            <li style="margin-right:20px; cursor:pointer;"><i class="fas fa-cog" style="color:white;" onclick="show_setting()"></i></li>
            <li style="position:relative; left:35px; color: white;"><?php echo $_SESSION['username']; ?></li>
            <?php foreach($call->data_user() as $key => $value) :?>
            <li style="position:relative; left:70px; color: white; top:-10px;"><img src="<?php echo $value['profile_pict']?>" class="profile"></li>
            <?php endforeach?>
        </ul>
        <div class="user-setting" id="target" >
            <ul>
                <?php foreach ($call->data_user() as $key => $value) : ?>
                    <li style="margin-top: 10px; position:relative; top:-10px; left:5px;"><i class="fas fa-info-circle" style="position: absolute; left:-22px;"></i><a href="info_admin.php?id=<?php echo $value['id'] ?>">Info saya</a></li>
                    <li style="position: relative; left:25px;"><i class="fas fa-wrench" style="position: absolute; left:-25px;"></i> <a href="setting_admin.php?id=<?php echo $value['id'] ?>">Pengaturan</a> </li>
                <?php endforeach ?>
                <li style="margin-top: 10px; position: relative; left:-10px;"> <i class="fas fa-sign-out-alt" style="position: relative; left:-5px;"></i> <a href="logout.php"> Keluar</a></li>
            </ul>
        </div>
    </div>
    <!-- end of navbar -->

    <!-- start of sidebar -->
    <div class="sidebar">
        <h2 style="color: white; text-align:center;"><i class="fas fa-user"></i> Admin </h2>
        <div class="garis" style="margin-top: -9px;"></div>
        <h3><i class="fas fa-tachometer-alt" style="color: white; margin-right:10px;"></i> <a href="admin.php?page=dashboard">Dashboard</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-book-medical" style="color: white; margin-right:10px;"></i> <a href="admin.php?page=insert">Tambah buku</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-swatchbook" style=" margin-right:10px;"></i> <a href="total.php">Total buku</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-window-restore" style=" margin-right:10px;"></i> <a href="admin.php?page=pinjaman">Daftar pinjaman</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-users" style=" margin-right:10px;"></i> <a href="allmember.php">Daftar Member</a> </h3>
        <div class="garis"></div>
        <h3><i class="fas fa-exclamation" style=" margin-right:10px;"></i><a href="admin.php?page=complain">Daftar complain</a> </h3>
        <div class="garis"></div>
        
    </div>
    <!-- end of sidebar -->

    <!-- start of ubah buku -->
    <div class="insert-book">
        <form method="POST" action="ubah_proses.php" enctype="multipart/form-data">
            <?php foreach($call->buku_data($id) as $key => $value) :?>        
            <div class="form-insert">
                <h1 style="color: blue;">Ubah Buku</h1>
                <input type="hidden" name="id" value="<?php echo $value['id_buku']?>">
                <span style="font-size:18px; margin-left:40px;">Cover buku</span>
                    <button class="upload" type="button" onclick="$('#file').click()">Upload</button><span style="margin-left: 30px;">preview</span> <input type="file" name="file" id="file" style="display: none;" onchange="loadFile(event)"> <img id="output" style="width: 150px; height:100px;"><br><br>
                    <label style=" position: relative; left: 100px;">Judul Buku</label><br><br>
                    <input type="text" name="ubah_judul" placeholder="Judul buku" value="<?php echo $value['judul']?>"><br><br>
                    <label style=" position: relative; left: 100px;">Sinopsis</label><br><br>
                    <textarea name="ubah_sinopsis"><?php echo $value['sinopsis']?></textarea><br><br>
                    <label style=" position: relative; left: 100px;">Stock Buku</label><br><br>
                    <input type="text" name="ubah_stock" placeholder="masukkan stock buku" value="<?php echo $value['stock']?>"><br><br>
                    <button type="submit" class="submit">Ubah</button>
            </div>
            <?php endforeach?>
        </form>
    </div>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <script src="index.js"></script>
    <script src="../../jquery.js"></script>
</body>

</html>