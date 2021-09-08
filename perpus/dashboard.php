<?php
require_once('library.php');
if(!isset($_SESSION['username'])){
    header('location:index.php');
}
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
<style>
    tr th {
        background-color: #07abf7;
        color: white;
    }

    table {
        border-collapse: collapse;
        margin-left: 310px;
        margin-top: 20px;
        background-color: white;
    }

    tr td {
        text-align: center;
    }

    table tr:nth-child(odd) {
        background-color: #f0f1f2;
    }
</style>
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

    <!-- start of search book  -->
    <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">Cari Buku</h1>
            <form method="GET" action="">
                <input type="text" name="cari" placeholder="Cari Buku" class="search"> <button type="submit" class="icn_search" ><i class="fas fa-search"></i></button> 
            </form>
            <table  cellspacing=0 cellpadding=10 style="margin-left: 250px; margin-top:20px;">
                <tr>
                    <th>no</th>
                    <th>Judul Buku</th>
                    <th >sinopsis</th>
                    <th>Gambar Buku</th>
                    <th>Stok Buku</th>
                    <th>Penerbit</th>
                    <th>Opsi</th>
                </tr>
                <?php
                $no = 1;
                if($call->buku_search() !== false)
                foreach($call->buku_search() as $key => $value) :?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $value['judul'] ?></td>
                    <td><?php echo $value['sinopsis'] ?></td>
                    <td><img src="<?php echo $value['gambar_buku'] ?>" style="width: 50px; height:50px; margin-left:20px;"> </td>
                    <td><?php echo $value['stock'] ?></td>
                    <td><?php echo $value['penerbit']?></td>
                    <td><button type="submit" class="btn-pinjam"><a href="pinjam_buku.php?id=<?php echo $value['id_buku']?>" style="text-decoration: none; color:white;">Pinjam Buku</a></button></td>
                </tr>
                <?php endforeach?>
            </table>
            </div>
        <!-- end of search book -->
    <script src="index.js?<?php echo time() ?>"></script>
    <script src="../../jquery.js"></script>
</body>

</html>