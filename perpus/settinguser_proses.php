<?php 
require_once('library.php');
$call = new perpus;

$id = $_POST['id'];

if($call->file_allow() == false){
    echo "<script>
    alert('ekstensi tidak diizinkan');
    window.location='setting_user.php?id=$id';
    </script>
    "
    ;
    exit;
}

$call->user_update($id);
echo "<script>
alert('data berhasil di ubah!');
window.location='dashboard.php';
</script>
"
;

?>