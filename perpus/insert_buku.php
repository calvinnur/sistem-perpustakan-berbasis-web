<?php 
require_once('library.php');
$call = new perpus;

if($call->file_allow() == false){
    echo "<script>
    alert('ekstensi tidak sesuai!');
    window.location='admin.php?page=insert';
    </script>
    "
    ;
    exit;
}

if($call->required_form() == false){
    echo "<script>
    alert('mohon isi form yang telah tersedia');
    window.location='admin.php?page=insert';
    </script>
    "
    ;
    exit;
}

if($call->judul_check() > 0){
    echo "<script>
    alert('anda tidak bisa memasukan judul buku yang sama!');
    window.location='admin.php?page=insert';
    </script>
    "
    ;
    exit;
}

$call->buku_insert();
echo "<script>
alert('data berhasil ditambahkan');
window.location='admin.php?page=insert';
</script>
";


?>