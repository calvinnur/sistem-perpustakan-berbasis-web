<?php 
require_once('library.php');
$call = new perpus;

$id = $_GET['id'];

if($call->peminjam_delete($id) > 0){
    echo "<script>
    alert('data berhasil dihapus');
    window.location='admin.php?page=pinjaman';
    </script>
    ";
}else{
    echo "<script>
    alert('data gagal dihapus');
    window.location='admin.php?page=pinjaman';
    </script>
    ";
}

?>