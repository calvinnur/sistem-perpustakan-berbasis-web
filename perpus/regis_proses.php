<?php 
require_once('library.php');
$call = new perpus;

if($call->required_regis() == false){
    echo "<script>
    alert('mohon isi form yang telah disediakan');
    window.location='register.php';
    </script>
    ";
    exit;
}

if($call->password_max() == false){
    echo "<script>
    alert('password anda kurang dari 6 dan lebih dari 12');
    window.location='register.php';
    </script>
    ";
    exit;
}

if($call->password_match() == false){
    echo "<script>
    alert('password tidak sama');
    window.location='register.php';
    </script>
    ";
    exit;
}

if($call->phonenmbr() == false){
    echo "<script>
    alert('mohon masukkan no telp dengan benar');
    window.location='register.php';
    </script>
    ";
    exit;
}

if($call->check_user() > 0){
    echo "<script>
    alert('username telah terpakai silahkan ganti');
    window.location='register.php';
    </script>
    ";
    exit;
}

$call->user_insert();
echo "<script>
alert('selamat anda berhasil membuat akun!');
window.location='index.php';
</script>
";
?>