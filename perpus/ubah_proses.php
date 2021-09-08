<?php 
require_once('library.php');
$call = new perpus;

$id = $_POST['id'];


if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name'])){
    if($call->file_allow() !== false){
        $call->buku_update($id);
        echo "<script>
        alert('data berhasil di update');
        window.location='total.php';
        </script>
        ";
        exit;
    }
}
$call->update_altern($id);
header('location:total.php');

?>