<?php 
require_once('library.php');
$call = new perpus;

$call->pengembalian_insert();
$call->pengembalian_stock();
echo"<script>
alert('buku berhasil dikembalikan');
window.location='dashboard.php';
</script>
"
;
?>