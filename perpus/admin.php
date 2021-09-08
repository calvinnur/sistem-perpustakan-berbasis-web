<?php
require_once('library.php');
// if (!isset($_SESSION['username'])) {
//     header('location:index.php');
// }
$call = new perpus;
$page = null;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    header('location:admin.php?page=dashboard');
    exit;
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
        margin-left: 310px;
        margin-top: 20px;
        background-color: white;
    }

    tr td {
        text-align: center;

    }

    table tr:nth-child(even) {
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
        <div class="copyright"></div>
        <p style="color: white; font-size:14px; text-align:center;">Copyright My Website 2021</p>          
    </div>

    <!-- end of sidebar -->

    <!-- start of dashboard admin -->
    <?php if ($page == 'dashboard') { ?>

        <div class="insert-book">
        
            <div class="card-info" style="margin-left: 120px;">
                <div class="logo-card">
                    <div class="img-logo-card" style="background-color: blue;">
                    <h1><i class="fas fa-users" style="color:white; margin-left:20px;"></i></h1>
                    </div>
                </div>
                <h2 ><?php echo $call->user_count() ?></h2>
                <p>Total user</p>
            </div>



            <div class="card-info" style="background-color: white;">
            <div class="logo-card">
                    <div class="img-logo-card " style="background-color: #12bf06;">
                    <h1><i class="fas fa-book"  style="color:white; margin-left:25px;"></i></h1>
                    </div>
                </div>
                <h2><?php echo $call->book_total()?></h2>
                <p>Total buku</p>
            </div>

            <div class="card-info" style="background-color: white;">
            <div class="logo-card">
                    <div class="img-logo-card " style="background-color: #05fbff;">
                    <h1><i class="fas fa-window-restore" style="color:white; margin-left:25px;"></i></h1>
                    </div>
                </div>
                <h2><?php echo $call->total_pinjaman()?></h2>
                <p>Pinjaman</p>
            </div>

            <div class="card-info" style="background-color: white;">
            <div class="logo-card">
                    <div class="img-logo-card " style="background-color: #c505ff;">
                    <h1><i class="fas fa-exclamation" style="color:white; margin-left:35px;"></i></h1>
                    </div>
                </div>
                <h2><?php echo $call->complain_total()?></h2>
                <p>Complain</p>
            </div>

        

            
        </div>
    <?php } elseif ($page == 'insert') { ?>
        <!-- insert book menu -->
        <div class="insert-book">
            <form method="POST" action="insert_buku.php" enctype="multipart/form-data">
                <div class="form-insert">
                    <h1 style="color: blue;">Tambah Buku</h1><br>
                    <span style="font-size:18px; margin-left:40px;">Cover buku</span>
                    <button class="upload" type="button" onclick="$('#file').click()">Upload</button><span style="margin-left: 30px;">preview</span> <input type="file" name="file" id="file" style="display: none;" onchange="loadFile(event)"> <img id="output" style="width: 150px; height:100px;"><br><br>
                    <label style=" position: relative; left: 100px;">Judul Buku</label><br><br>
                    <input type="text" name="judul" placeholder="Judul buku" required><br><br>
                    <label style=" position: relative; left: 100px;">Sinopsis</label><br><br>
                    <textarea name="sinopsis" required></textarea><br><br>
                    <label style=" position: relative; left: 100px;">Stock Buku</label><br><br>
                    <input type="text" name="stock" placeholder="masukkan stock buku" required><br><br>
                    <label style=" position: relative; left: 100px;">Penerbit Buku</label><br><br>
                    <input type="text" name="penerbit" placeholder="masukkan nama pernerbit" required><br><br>
                    <button type="submit" class="submit">Tambah</button>
                </div>
            </form>
        </div>

    <?php } elseif ($page == 'pinjaman') { ?>
        <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">Cari daftar peminjam</h1>
            <form method="GET" action="admin.php?page=total">
                <input type="text" name="cari" placeholder="Cari daftar peminjam" class="search"><input type="hidden" name="page" value="pinjaman"> <button type="submit" class="icn_search"><i class="fas fa-search"></i></button>
            </form>
            
            <table cellspacing=0 cellpadding=10  style="margin-left: 200px;">
                <tr>
                    <th>no</th>
                    <th>Username</th>
                    <th>judul</th>
                    <th>tanggal pinjam</th>
                    <th>tanggal mengembalikan</th>
                    <th>Jumlah buku yang dipinjam</th>
                    <th>Opsi</th>
                </tr>
                <?php
                $no = 1;
                if ($call->peminjam_daftar() !== false)
                    foreach ($call->peminjam_daftar() as $key => $value) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['judul'] ?></td>
                        <td><?php echo date('d M Y', $value['start'])  ?></td>
                        <td ><?php echo  date('d M Y', $value['end']) ?></td>
                        <td ><?php echo $value['jumlah_buku'] ?></td>
                        <td><button type="button" class="btn-delete"><a href="delete_peminjam.php?id=<?php echo $value['id']?>"><i class="far fa-trash-alt" style="color: white;"></i></a></button></td>
                    </tr>
                <?php endforeach ?>
            </table>
            
        </div>
    <?php  } elseif ($page == 'complain') { ?>
        <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">Cari daftar complain</h1>
            <form method="GET" action="admin.php?page=complain">
                <input type="text" name="cari" placeholder="Cari daftar peminjam" class="search"><input type="hidden" name="page" value="complain"> <button type="submit" class="icn_search"><i class="fas fa-search"></i></button>
            </form>
            <table cellspacing=0 cellpadding=10 >
                <tr>
                    <th>no</th>
                    <th>Username</th>
                    <th>judul buku</th>
                    <th>komplain</th>
                    <th>waktu komplain</th>
                    <th>Opsi</th>
                </tr>
                <?php
                $no = 1;
                if ($call->komplain_search() !== false)
                    foreach ($call->komplain_search() as $key => $value) : ?>
                    <tr>
                        
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['judul_buku'] ?></td>
                        <td><?php echo $value['komplain'] ?></td>
                        <td style="text-align: center;"><?php echo  date('d M Y', $value['waktu_komplain']) ?></td>
                        <td><button type="button" class="btn-delete"><a href="delete_komp.php?id=<?php echo $value['id'] ?>" style="text-decoration: none; color:white;">Delete</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php }elseif($page == 'pengembalianbuku'){?>
        <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">Cari daftar pengembalian</h1>
            <form method="GET" action="admin.php?page=pengembalianbuku">
                <input type="text" name="cari" placeholder="Cari daftar peminjam" class="search"><input type="hidden" name="page" value="pengembalianbuku"> <button type="submit" class="icn_search"><i class="fas fa-search"></i></button>
            </form>
           
            <table cellspacing=0 cellpadding=10  style="margin-left: 200px;">
                <tr>
                    <th>no</th>
                    <th>Username</th>
                    <th>judul</th>
                    <th>tanggal mengembalikan</th>
                    <th>Jumlah buku yang dipinjam</th>
                    <th>Opsi</th>
                </tr>
                <?php
                $no = 1;
                if ($call->pengembalian_search() !== false)
                    foreach ($call->pengembalian_search() as $key => $value) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['judul_buku'] ?></td>
                        <td ><?php echo  date('d M Y', $value['waktu']) ?></td>
                        <td ><?php echo $value['jumlah_buku'] ?></td>
                        <td><button type="button" class="btn-delete"><a href="delete_pengembalian.php?id=<?php echo $value['id']?>"><i class="far fa-trash-alt" style="color: white;"></i></a></button></td>
                    </tr>
                <?php endforeach ?>
            </table>
        
        </div>
    <?php } ?>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script src="index.js"></script>
    <script src="../../jquery.js"></script>
</body>

</html>