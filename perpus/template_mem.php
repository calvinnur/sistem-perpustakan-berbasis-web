<?php
require_once('library.php');
if(!isset($_SESSION['username'])){
    header('location:index.php');
}
$call = new perpus;
$page = null;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    header('location:dashboard.php');
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

    <?php if($page == 'pinjaman'){?>

        <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">pinjaman Saya</h1>
            <form method="GET" action="">
                <input type="text" name="cari" placeholder="Cari Pinjaman" class="search"><input type="text" name="page" placeholder="Cari Pinjaman" class="search" style="display: none;" value="pinjaman"> <button type="submit" class="icn_search" ><i class="fas fa-search"></i></button> 
            </form>
            <table cellspacing=0 cellpadding=10 style="margin-left: 270px; margin-top:20px;">
                <tr>
                    <th>no</th>
                    <th>Judul Buku</th>
                    <th>tanggal peminjaman</th>
                    <th>tanggal pengembalian</th>
                    <th>Buku yang dipinjam</th>
                </tr>
                <?php
                $no = 1;
                if($call->saya_pinjaman() !== false)
                foreach($call->saya_pinjaman() as $key => $value) :?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $value['judul'] ?></td>
                    <td><?php echo date('d M Y',$value['start']) ?></td>
                    <td><?php echo date('d M Y',$value['end']) ?></td>
                    <td ><?php echo $value['jumlah_buku'] ?></td>
            
                </tr>
                <?php endforeach?>
            </table>
            </div>

    <?php }elseif($page == 'status'){ ?>
        <div class="insert-book" style="margin-top:100px;">
            <h1 style="text-align:center; color:blue; ">pinjaman Saya</h1>
            <form method="GET" action="">
                <input type="text" name="cari" placeholder="Cari Pinjaman" class="search"><input type="text" name="page" placeholder="Cari Pinjaman" class="search" style="display: none;" value="pinjaman"> <button type="submit" class="icn_search" ><i class="fas fa-search"></i></button> 
            </form>
            <table cellspacing=0 cellpadding=10 style="margin-left: 200px; margin-top:20px;">
                <tr>
                    <th>no</th>
                    <th>Judul Buku</th>
                    <th>tanggal peminjaman</th>
                    <th>tanggal pengembalian</th>
                    <th>Buku yang dipinjam</th>
                    <th >Status</th>
                </tr>
                <?php
                $no = 1;
                if($call->saya_pinjaman() !== false)
                foreach($call->saya_pinjaman() as $key => $value) :?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $value['judul'] ?></td>
                    <td style="text-align: center;"><?php echo date('d M Y',$value['start']) ?></td>
                    <td  style="text-align: center;"><?php echo date('d M Y',$value['end']) ?></td>
                    <td style="text-align: center;"><?php echo $value['jumlah_buku'] ?></td>
                    <td><?php if(time() > $value['end'])
                    {
                        echo "kadaluarsa";
                    }else{
                        echo "masih berlanjut";
                    }
                    ?></td>
                </tr>
                <?php endforeach?>
            </table>
            </div>
      <?php }elseif($page == 'komplain'){?>
        <div class="insert-book">
            <form method="POST" action="proses_komplain.php" >
                <div class="form-insert" style="height: 420px;">
                    <h1 style="color: blue;">Complain Buku</h1><br>
                    <label style=" position: relative; left: 100px;">Judul Buku yang dipinjam</label><br><br>
                    <select name="buku">
                    <?php foreach($call->user_buku() as $key => $value) :?>
                    <option><?php echo $value['judul']?></option>
                    <?php endforeach?>
                    </select><br>
                    <label style=" position: relative; left: 100px; top:10px;">Complain</label><br><br>
                    <textarea name="complain" required></textarea><br><br>
                    <button type="submit" class="submit">Complain</button>
                </div>
            </form>
        </div>
      <?php }elseif($page == 'pengembalian'){?>

        <div class="insert-book">
            <form method="POST" action="pengembalian.php" >
                <div class="form-insert" style="height: 420px;">
                    <h1 style="color: blue;">Pengembalian Buku</h1><br>
                    <label style=" position: relative; left: 100px;">Judul Buku yang dipinjam</label><br><br>
                    <select name="buku">
                    <?php foreach($call->pinjaman_get() as $key => $value) :?>
                    <option><?php echo $value['judul']?></option>
                    <?php endforeach?>
                    </select><br><br>
                    <label style=" position: relative; left: 100px;">Jumlah buku yang dipinjam</label><br><br>
                    <select name="jumlah">
                    <?php foreach($call->pinjaman_get() as $key => $value) :?>
                        <option><?php echo $value['jumlah_buku']?></option>
                    <?php endforeach?>
                    </select><br><br>
                    <label style=" position: relative; left: 100px;">Tanggal pengembalian</label><br><br>
                    <input type="date" name="pengembalian">
                    <button type="submit" class="submit" style="margin-top: 30px;">Kembalikan</button>
                </div>
            </form>
        </div>

      <?php } ?>
    <script src="index.js?<?php echo time() ?>"></script>
    <script src="../../jquery.js"></script>
</body>

</html>