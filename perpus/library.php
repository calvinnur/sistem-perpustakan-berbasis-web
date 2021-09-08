<?php 
session_start();
class perpus{
    // membuat koneksi ke database
    protected function koneksi(){
        $connect = mysqli_connect('localhost','root','','perpustakaan');
        return $connect;
    }
    // membuat fungsi query
    protected function query($command){
        $query = mysqli_query($this->koneksi(), $command);
        return $query;
    }

    
    //start of registration

    //memasukan data user ke dalam database berdasarkan metode post
    protected function insert_user(){
        $query = $this->query("insert into user (username,password,role_id,phone_number,address,profile_pict) values(
            '".strip_tags($_POST['username'])."',
            '".password_hash($_POST['password'], PASSWORD_DEFAULT)."',
            '2',
            '".strip_tags($_POST['phone_number'])."',
            '".strip_tags($_POST['address'])."',
            '".'data/default.png'."'
        )");
        return $query;
    }
    // pengecekan user  di dalam database
    protected function user_check(){
        $query = $this->query("select * from user where username ='".$_POST['username']."'");
        $row = mysqli_num_rows($query);
        return $row;
    }
    public function check_user(){
        return $this->user_check();
    }
    public function user_insert(){
        return $this->insert_user();
    }
    // pengecekan jika kolom input kosong maka muncul pemberitahuan alert
    public function required_regis(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $retype = $_POST['retype'];
        $phone = $_POST['phone_number'];
        $address = $_POST['address'];
        if($username == '' and $password == '' and $retype == '' and $phone == '' and $address == ''){
            return false;
        }else{
            return true;
        }
    }
    // pengecekan password minimal 6 digit dan max 12 digit jika lebih dari itu akan muncul pemberitahuan
    public function password_max(){
        $password = $_POST['password'];
        $count_pass = strlen($password);
        if($count_pass >= 6 and $count_pass <= 12){
            return true;
        }else{
            return false;
        }
    }
    // pengecekan password dan retype password jika tidak sama akan erorr
    public function password_match(){
        $password = $_POST['password'];
        $retype = $_POST['retype'];
        if($password !== $retype){
            return false;
        }else{
            return true;
        }
    }
    // pengecekan no telp jika kurang dari 10 dan lebih dari 12 maka akan muncul pemberitahuan
    public function phonenmbr(){
        $phone = $_POST['phone_number'];
        if($phone >= 10 and $phone <= 12 ){
            return true;
        }else{
            return false;
        }
    }
        //end of registration

        //start of login

        //pengecekan username dan password kalau kosong akan muncul pemberitahuan

        public function login_required(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($username == '' and $password == ''){
                return false;
            }else{
                return true;
            }
        }

        //melakukan seleksi query pada tabel user untuk mendapatkan data pada tabel user berdasarkan post username

        protected function get_user(){
            $query = $this->query("select * from user where username ='".$_POST['username']."'");
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
            return $build;
        }
        public function user_get(){
            return $this->get_user();
        }
        //end of login

        // start of user setting
        
        //mendapatkan data user berdasarkan id user
        protected function setting_user($id){
            $query = $this->query("select * from user where id = $id");
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
            return $build;
        }

        // mengupdate data user berdasarkan id user
        protected function update_user($id){
            $query = $this->query("update user set 
            phone_number = '".strip_tags($_POST['phone_number'])."',
            address = '".strip_tags($_POST['address'])."',
            profile_pict = '".'data/'.$this->file()['name']."'
            where id = $id
             ");
             return $query;
        }

        // mendapatkan data user berdasarkan session['username']
        protected function user_data(){
            $query = $this->query("select * from user where username = '".$_SESSION['username']."'");
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
            return $query;
        }

        public function data_user(){
            return $this->user_data();
        }

        public function user_update($id){
            return $this->update_user($id);
        }

        public function user_setting($id){
            return $this->setting_user($id);
        }

         // end of user setting


         //start of insert buku

         // memanggil file
         public function file(){
             $file = $_FILES['file'];
             return $file;
         }

         // membuat ketentuan ekstensi
         public function get_ext(){
             $file_name = $this->file()['name'];
             $pisah = explode(".",$file_name);
             $ext = strtolower(end($pisah));
             $allow_ext = ["png","jpg","jpeg"];
             if(in_array($ext,$allow_ext)){
                 return true;
             }else{
                 return false;
             }
         }
        //  jika ekstensinya sesuai maka file akan tersimpan di dalam folder data 
         public function file_allow(){
            if($this->get_ext() == true){
                move_uploaded_file($this->file()['tmp_name'], 'data/' . $this->file()['name']);
                return true;
            }else{
                return false;
            }
         }
         
         // pengecekan judul di dalam database tambah_buku
         protected function check_judul(){
             $query = $this->query("select * from tambah_buku where judul = '".$_POST['judul']."'");
             $row = mysqli_num_rows($query);
             return $row;
         }
         //  memasukan data buku ke dalam tambah_buku melalui method post
         protected function insert_buku(){
             $query = $this->query("insert into tambah_buku (gambar_buku,judul,sinopsis,stock,penerbit,waktu) values(
                 '".'data/'.$this->file()['name']."',
                 '".strip_tags($_POST['judul'])."',
                 '".strip_tags($_POST['sinopsis'])."',
                 '".strip_tags($_POST['stock'])."',
                 '".strip_tags($_POST['penerbit'])."',
                 '".time()."'
             )");
             return $query;
         }

         public function judul_check(){
             return $this->check_judul();
         }

         public function buku_insert(){
             return $this->insert_buku();
         }

         // pengecekan form jika form kosong akan muncul pemberitahuan
         public function required_form(){
             $judul = $_POST['judul'];
             $sinopsis = $_POST['sinopsis'];
             $stock = $_POST['stock'];
             $penerbit = $_POST['penerbit'];
             if($judul == '' and $sinopsis == '' and $stock == '' and $penerbit == ''){
                 return false;
             }else{
                 return true;
             }
         }

        //  end of tambah buku

        //  start of search buku

        // pencarian total buku di halaman admin menggunakan method get
         protected function search_bukuadm(){
             $cari = null;
             if(isset($_GET['cari'])){
                 $cari = $_GET['cari'];
             }

             $query = $this->query("select * from tambah_buku where judul like '%$cari%' or sinopsis like '%$cari%'  or penerbit like '%$cari%' ");
             $row = mysqli_num_rows($query);
             if($row > 0){
                 while($show = mysqli_fetch_assoc($query)){
                     $build[] = $show;
                 }
             }else{
              
                 return false;
             }
             return $build;

         }
            // pencarian buku di halaman member untuk dipinjam
         protected function search_bukumem(){
            $cari = null;
            if(isset($_GET['cari'])){
                $cari = $_GET['cari'];
            }

            $query = $this->query("select * from tambah_buku where judul like '%$cari%' or sinopsis like '%$cari%' or penerbit like '%$cari%'");
            $row = mysqli_num_rows($query);
            if($row > 0){
                while($show = mysqli_fetch_assoc($query)){
                    $build[] = $show;
                }
            }else{
              
                return false;
            }
            return $build;

        }

         public function buku_search(){
             return $this->search_bukuadm();
         }

         public function search_mem(){
             return $this->search_bukumem();
         }

         // end of search buku
    
         //start of delete buku

        //  penghapusan data buku di tabel tambah_buku berdasarkan id buku
         protected function delete_buku($id){
             $query = $this->query("delete from tambah_buku where id_buku = $id");
             return $query;
         }

         public function buku_delete($id){
             return $this->delete_buku($id);
         }
         // end of delete buku

         // start of user_count

        //  menghitung total user berdasarkan role id
         protected function count_user(){
             $query = $this->query("select * from user where role_id = 2");
             $row = mysqli_num_rows($query);
             return $row;
         }

         public function user_count(){
             return $this->count_user();
         }

        // end of user_count

        // start of total_book  

        // menghitung total buku
        protected function total_book(){
            $query = $this->query("select * from tambah_buku");
            $row = mysqli_num_rows($query);
            return $row;
        }

        public function book_total(){
            return $this->total_book();
        }

        // end of total_book

        // start of ubah buku

        // mendapatkan data tambah_buku berdasarkan id
        protected function data_buku($id){
            $query = $this->query("select * from tambah_buku where id_buku = $id");
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
            return $build;
        }

        public function buku_data($id){
            return $this->data_buku($id);
        }
        //  mengupdate tabel data tambah_buku berdasarkan id
        protected function update_buku($id){
            $query = $this->query("update tambah_buku set
            gambar_buku = '".'data/'.$this->file()['name']."',
            judul = '".$_POST['ubah_judul']."',
            sinopsis = '".$_POST['ubah_sinopsis']."',
            stock = '".$_POST['ubah_stock']."'
            where id_buku = $id
            ");
            return $query;
        }
        // alternatif update jika admin tidak ingin mengubah gambar buku
        protected function altern_update($id){
            $query = $this->query("update tambah_buku set
            judul = '".$_POST['ubah_judul']."',
            sinopsis = '".$_POST['ubah_sinopsis']."',
            stock = '".$_POST['ubah_stock']."'
            where id_buku = $id
            ");
            return $query;
        }

        public function update_altern($id){
            return $this->altern_update($id);
        }

        public function buku_update($id){
            return $this->update_buku($id);
        }

        // start of search member

        // pembuatan pencarian member di halaman admin
        protected function user_search(){
            $cari = null;
            if(isset($_GET['cari'])){
                $cari = str_replace("'","", $_GET['cari']);
            }
            $query = $this->query("select * from user where (username like '%$cari%' or phone_number like '%$cari%' or address like '%$cari%') and role_id = '2' ");
            $row = mysqli_num_rows($query);
            if($row > 0){
                while($show = mysqli_fetch_assoc($query)){
                    $build[] = $show;
                }
            }else{
                echo "<script>
                alert('data tidak ditemukan!');
                window.location='allmember.php';
                </script>
                ";
                return false;
            }
            return $build;
        }

        public function search_user(){
            return $this->user_search();
        }

        // end of search member

        // start of pinjam buku

        // memasukkan data ke dalam tabel pinjaman berdasarkan method post dan session

        protected function insert_pinjaman(){
            $query = $this->query("insert into pinjaman (username,judul,start,end,jumlah_buku) values(
                '".$_SESSION['username']."',
                '".strip_tags($_POST['judul'])."',
                '".strtotime($_POST['awal'])."',
                '".strtotime($_POST['akhir'])."',
                '".strip_tags($_POST['jumlah_buku'])."'
            )");
            return $query;
        }

        public function pinjaman_insert(){
            return $this->insert_pinjaman();
        }
        // fungsi batas peminjaman jika lebih dari satu maka akan muncul pemberitahuan
        public function max_pinjaman(){
            $jumlah = $_POST['jumlah_buku'];
            if($jumlah > 1){
                return false;
            }else{
                return true;
            }
        }

        
        // peng updatean jika buku telah dipinjam oleh user maka stock akan berkurang
        protected function update_stock(){
            $jumlah = $_POST['jumlah_buku'];
            $stock = $this->query("select * from tambah_buku where id_buku = '".$_POST['id']."' ");
            $show = mysqli_fetch_assoc($stock);
                $hitung_buku = $show['stock'] - $jumlah ;
            
            $update = $this->query("update tambah_buku set  stock = '$hitung_buku'  where id_buku = '".$_POST['id']."' 
            ");
            return $update;
        }

        public function stock_update(){
            return $this->update_stock();
        }
        // perhitungan untuk jumlah pinjaman
        protected function hitung_pinjaman(){
            $query = $this->query("select * from pinjaman");
            $row = mysqli_num_rows($query);
            return $row;
        }
        public function total_pinjaman(){
            return $this->hitung_pinjaman();
        }
        //  fungsi jika stok kurang dari satu maka tidak bisa meminjam buku
        protected function hitung_stock(){
            $query = $this->query("select * from tambah_buku where id_buku = '".$_POST['id']."' ");
            $stock = mysqli_fetch_assoc($query);
            if($stock['stock'] < 1){
                return false;
            }else{
                return true;
            }

        }

        public function stock_hitung(){
            return $this->hitung_stock();
        }
        //  pencarian buku yang telah dipinjam oleh user
        protected function pinjaman_saya(){
            $cari = null;
            if(isset($_GET['cari'])){
                $cari = str_replace("'","",$_GET['cari']);
            }
            $query = $this->query("select * from pinjaman where (judul like '%$cari%') and username = '".$_SESSION['username']."'");
            $row = mysqli_num_rows($query);
            if($row > 0){
                while($show = mysqli_fetch_assoc($query)){
                    $build[] = $show;
                }
            }else{
                return false;
            }
            return $build;
        }

        public function saya_pinjaman(){
            return $this->pinjaman_saya();
        }
        // fungsi untuk mencari daftar peminjam
        protected function daftar_peminjam(){
            $cari = null;
            if(isset($_GET['cari'])){
                $cari = str_replace("'","",$_GET['cari']) ;
            }
            $query = $this->query("select * from pinjaman where username like '%$cari%' ");
            $row = mysqli_num_rows($query);
            if($row > 0){
                while($show = mysqli_fetch_assoc($query)){
                    $build[] = $show;
                }
            }else{
                echo "data tidak ditemukan";
                return false;
            }
            return $build;
        }
        //  fungsi untuk user tidak bisa meminjam buku yang sama berulang kali
        protected function check_buku(){
            $query = $this->query("select * from pinjaman where username = '".$_SESSION['username']."' ");
            $show = mysqli_fetch_assoc($query);
            if($show['judul'] == $_POST['judul']){
                return false;
            }else{
                return true;
            }
        }

        // fungsi menghapus peminjam berdasarkan id pada database
        protected function delete_peminjam($id){
            $query = $this->query("delete from pinjaman where id = $id");
            return $query;
        }

        public function peminjam_delete($id){
            return $this->delete_peminjam($id);
        }

        public function peminjam_daftar(){
            return $this->daftar_peminjam();
        }

        public function buku_check(){
            return $this->check_buku();
        }

        // fungsi untuk mengecek kekosongan kolom pada field peminjam
        public function required_pinjam(){
            $awal = $_POST['awal'];
            $akhir = $_POST['akhir'];
            $jumlah = $_POST['jumlah_buku'];
            if($awal == '' and $akhir == '' and $jumlah == ''){
                return false;
            }else{
                return true;
            }
        }

        // end of pinjam buku

        // start of komplain buku user

        // fungsi untuk memasukan data komplain pada database
        protected function buku_complain(){
            $query = $this->query("insert into komplain (username,komplain,judul_buku,waktu_komplain) values(
                '".$_SESSION['username']."',
                '".strip_tags($_POST['complain'])."',
                '".strip_tags($_POST['buku'])."',
                '".time()."'
            )");
            return $query;
        }
        //  fungsi untuk mendapatkan data pinjaman buku berdasarkan session username
        protected function buku_user(){
            $query = $this->query("select * from pinjaman where username = '".$_SESSION['username']."' ");
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
            return $build;
        }


        public function user_buku(){
            return $this->buku_user();
        }
        public function complain_buku(){
            return $this->buku_complain();
        }

        //  fungsi untuk mengecek kolom field komplain kosong atau tidak
        public function required_komplain(){
            $complain = $_POST['complain'];
            if($complain == ''){
                return false;
            }else{
                return true;
            }
        }
        // end of komplain buku user

        // start of pencarian komplain

        // fungsi untuk mencari komplain user pada halaman admin
        protected function search_komplain(){
            $cari = null;
            if(isset($_GET['cari'])){
                $cari = str_replace("'","",$_GET['cari']);
            }
            $query = $this->query("select * from komplain where username like '%$cari%' ");
            $row = mysqli_num_rows($query);
            if($row > 0){
                while($show = mysqli_fetch_assoc($query)){
                    $build[] = $show;
                }
            }else{
               
                return false;
            }
            return $build;
        }

        public function komplain_search(){
            return $this->search_komplain();
        }

        // menghapus data komplain berdasarkan id database
        protected function delete_komplain($id){
            $query = $this->query("delete from komplain where id = $id");
            return $query;
        }
        public function komplain_delete($id){
            return $this->delete_komplain($id);
        }

        // menghitung total complain buku pada halaman admin
        protected function total_complain(){
            $query = $this->query("select * from komplain");
            $row = mysqli_num_rows($query);
            return $row;
        }

        public function complain_total(){
            return $this->total_complain();
        }
    // end of complain buku

    // start of pengembalian buku

    // fungsi untuk mendapatkan data pinjaman berdasarkan session username
    protected function get_pinjaman(){
        $query = $this->query("select * from pinjaman where username = '".$_SESSION['username']."'");
       while ($show = mysqli_fetch_assoc($query)){
           $build[] = $show;
       }
       return $build;
    }

    // fungsi untuk menambahkan data pada tabel pengembalian
    protected function insert_pengembalian(){
        $query = $this->query("insert into pengembalian (username,waktu,judul_buku,jumlah_buku) values(
            '".$_SESSION['username']."',
            '".strtotime($_POST['pengembalian'])."',
            '".$_POST['buku']."',
            '".$_POST['jumlah']."'
        )");
        return $query;
    }

    // fungsi dikala user sudah mengembalikan buku stok buku akan bertambah
    protected function stock_pengembalian(){
        $query = $this->query("select * from pengembalian where jumlah_buku = '".$_POST['jumlah']."'");
        $querys = $this->query("select * from tambah_buku where judul = '".$_POST['buku']."' ");
        $show_stock = mysqli_fetch_assoc($query);
        $show_pengembalian = mysqli_fetch_assoc($querys);
        $stock_buku = $show_stock['jumlah_buku'];
        $stock_total = $show_pengembalian['stock'];
        $jumlah_stock = $stock_total + $stock_buku;
        $update = $this->query("update tambah_buku set
        stock = '$jumlah_stock' where judul = '".$_POST['buku']."'
        ");
        return $update;
    }

    public function pengembalian_stock(){
        return $this->stock_pengembalian();
    }

    public function pengembalian_insert(){
        return $this->insert_pengembalian();
    }

    public function pinjaman_get(){
        return $this->get_pinjaman();
    }
// end of pengembalian buku member

// start of pengembalian buku admin

// fungsi untuk mencari pengembalian buku user pada halaman admin
    protected function search_pengembalian(){
        $cari = null;
        if(isset($_GET['cari'])){
            $cari = str_replace("'","",$_GET['cari']);
        }
        $query = $this->query("select * from pengembalian where username like '%$cari%'");
        $row = mysqli_num_rows($query);
        if($row > 0){
            while($show = mysqli_fetch_assoc($query)){
                $build[] = $show;
            }
        }else{
            return false;
        }
        return $build;
    }

    // menghapus data pengembalian buku berdasarkan id pengembalian 
    protected function delete_pengembalian($id){
        $query = $this->query("delete from pengembalian where id = $id");
        return $query;
    }

    public function pengembalian_delete($id){
        return $this->delete_pengembalian($id);
    }

    public function pengembalian_search(){
        return $this->search_pengembalian();
    }

} 

?>