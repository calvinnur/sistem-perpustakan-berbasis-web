<?php
require_once('library.php');
$call = new perpus;


if ($call->max_pinjaman() == true) {
    if ($call->stock_hitung() == true) {
        if ($call->buku_check() == true) {
            if($call->required_pinjam() == true){
                $call->pinjaman_insert();
                $call->stock_update();
                echo "<script>
                    alert('buku berhasil dipinjam');
                    window.location='dashboard.php'
                    </script>
            ";
            }else{
                echo "<script>
                alert('mohon isi form yang telah disediakan');
                window.location='dashboard.php'
                </script>
        ";
            } 
        }else{
            echo "<script>
            alert('mohon maaf anda telah meminjam buku ini');
            window.location='dashboard.php'
            </script>
            ";
        }
    } else {
        echo "<script>
        alert('mohon maaf stock telah habis silahkan pilih buku lain');
        window.location='dashboard.php'
        </script>
        ";
    }
} else {
    echo "<script>
    alert('hanya boleh meminjam satu buku untuk satu jenis!');
    window.location='dashboard.php'
    </script>
    ";
}
