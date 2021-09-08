<?php 
require_once('library.php');
$call = new perpus;

$id = $_GET['id'];

if($call->buku_delete($id) > 0){
    echo "<script>
    alert('data berhasil dihapus');
    window.location='total.php';
    </script>
    ";
}else{
    echo "<script>
    alert('data gagal dihapus');
    window.location='total.php';
    </script>
    ";
}

?>