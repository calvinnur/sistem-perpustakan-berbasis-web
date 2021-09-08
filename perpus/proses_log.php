<?php 
require_once('library.php');
$call = new perpus;

if($call->login_required() == false){
    echo "<script>
    alert('mohon diisi form yang telah disediakan');
    window.location='index.php';
    </script>
    ";
    exit;
}
if($call->check_user() == 0){
    echo "<script>
    alert('silahkan melakukan registrasi terlebih dahulu');
    window.location='index.php';
    </script>
    ";
    exit;
}
foreach($call->user_get() as $key => $value){
    $_SESSION['username'] = $_POST['username'];
    if(password_verify($_POST['password'], $value['password'])){
        if($value['role_id'] == 2){
            echo "<script>
            alert('selamat datang ".$value['username']."');
            window.location='dashboard.php';
            </script>
            ";
        }else{
            echo "<script>
            alert('selamat datang ".$value['username']."');
            window.location='admin.php?page=dashboard';
            </script>
            ";
        }
    }else{
        echo "<script>
        alert('password salah');
        window.location='index.php';
        </script>
        ";
    }
}
?>