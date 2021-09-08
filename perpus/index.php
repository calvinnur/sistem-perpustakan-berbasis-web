
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css?<?php echo time() ?>">
    <title>Welcome to perpustakaan</title>
</head>

<body >

<div class="background-login"><img src="data/perpus.jpg"></div>
    <form method="POST" action="proses_log.php">
        <div class="form-login" >
            <img src="data/logo-perpus.png" style="width: 40px; height:40px; margin-left:40px; margin-top:10px;"><span>Login</span><br>
            
            <input type="text" name="username" placeholder="Username" style="margin-top: 10px;" required><br>
            <input type="password" name="password" placeholder="Password" style="margin-top: 10px;" required><br>
            <button type="submit">Masuk</button>
            <p style="font-size: 12px; text-align:center; color:blue;">Belum punya akun? silahkan registrasi <a href="register.php" style="text-decoration: none; color:orange;">disini</a> </p>
    </form>
  
    </div>

</body>

</html>