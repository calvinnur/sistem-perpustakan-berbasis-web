<?php
require_once('library.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css?<?php echo time() ?>">
    <title>Document</title>
</head>

<body>
   
<div class="background-login"><img src="data/perpus.jpg"></div>
    <form method="POST" action="regis_proses.php">
        <div class="form-login" style="height: 450px;">
        <img src="data/logo-perpus.png" style="width: 40px; height:40px; margin-left:40px; margin-top:10px;"><span style="left:60px;">Register</span><br>
           
            <input type="text" name="username" placeholder="Username" style="margin-top:10px;" required><br>
           
            <input type="password" name="password" placeholder="Password" style="margin-top:10px;" required><br>
        
            <input type="password" name="retype" placeholder="Ulangi password" style="margin-top:10px;" required><br>
          
            <input type="text" name="address" placeholder="Alamat anda" style="margin-top:10px;" required><br>
            
            <input type="text" name="phone_number" placeholder="No telp anda" style="margin-top:10px;" required><br>
            <button type="submit">Daftar</button>
            <p style="font-size: 12px; text-align:center; color:blue;">sudah punya akun? silahkan login <a href="index.php" style="text-decoration: none; color:orange;">disini</a> </p>
        </div>
    </form>
</body>

</html>