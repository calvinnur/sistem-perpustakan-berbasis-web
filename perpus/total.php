<?php
require_once('library.php');
require_once('qrcode/qrlib.php');
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$call = new perpus;
$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
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
        margin-left: 200px;
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
            <?php foreach ($call->data_user() as $key => $value) : ?>
                <li style="position:relative; left:70px; color: black; top:-10px;"><img src="<?php echo $value['profile_pict'] ?>" class="profile"></li>
            <?php endforeach ?>
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
        <h3><i class="far fa-hand-point-left"  style=" margin-right:10px;"></i><a href="admin.php?page=pengembalianbuku">Pengembalian</a> </h3>
        <div class="garis"></div>
        <div class="copyright" style="padding: 25%;"></div>
        <p style="color: white; font-size:14px; text-align:center;">Copyright My Website 2021</p>
    </div>
    <!-- end of sidebar -->

    <div class="insert-book" style="margin-top:100px;">
        <h1 style="text-align:center; color:blue; ">Cari Buku</h1>
        <form method="GET" action="">
            <input type="text" name="cari" placeholder="Cari Buku" class="search"> <button type="submit" class="icn_search"><i class="fas fa-search"></i></button>
        </form>

        
            <table cellspacing=0 cellpadding=10 >
                <tr>
                    <th>no</th>
                    <th>Qrcode</th>
                    <th>Judul Buku</th>
                    <th>sinopsis</th>
                    <th>Gambar Buku</th>
                    <th>Stok Buku</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                if ($call->buku_search() !== false)
                    foreach ($call->buku_search() as $key => $value) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td>
                            <?php
                            $total = "judul buku: " . $value['judul'] . " " . "stock buku: " . $value['stock'] . "Penerbit Buku: " . $value['penerbit'] . "";
                            QRcode::png($total, "total" . $no . ".png", "M", 2, 2);
                            ?>
                            <img src="total<?php echo $no ?>.png">
                        </td>
                        <td><?php echo $value['judul'] ?></td>
                        <td><?php echo $value['sinopsis'] ?></td>
                        <td><img src="<?php echo $value['gambar_buku'] ?>" style="width: 50px; height:50px; margin-left:20px;"> </td>
                        <td><?php echo $value['stock'] ?></td>
                        <td><?php echo $value['penerbit'] ?></td>
                        <td><button type="button" class="btn-delete"><a href="hapus.php?id=<?php echo $value['id_buku'] ?>"><i class="far fa-trash-alt" style="color: white;"></i></a></button>
                            <button type="button" class="btn-update"><a href="ubah_buku.php?id=<?php echo $value['id_buku'] ?>"><i class="far fa-edit" style="color: white; position:relative; left:3px;"></i></a></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
     
    </div>



    <script src="index.js"></script>
    <script src="../../jquery.js"></script>
</body>

</html>