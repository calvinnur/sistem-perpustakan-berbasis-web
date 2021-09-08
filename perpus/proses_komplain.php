<?php 
require_once('library.php');
$call = new perpus;

if($call->required_komplain() == false){
    echo "<script>
    alert('mohon isi form yang telah tersedia');
    window.location='template_mem.php?page=komplain';
    </script>
    "
    ;
    exit;
}
if($call->complain_buku() > 0){
    echo "<script>
    alert('berhasil mengirimkan komplain!');
    window.location='template_mem.php?page=komplain';
    </script>
    "
    ;
}else{
    echo "<script>
    alert('gagal mengirimkan komplain!');
    window.location='template_mem.php?page=komplain';
    </script>
    "
    ;
}

?>