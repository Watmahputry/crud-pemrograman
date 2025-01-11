<?php
//Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud";

//buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die (mysqli_error($koneksi));



//jika tombol simpan diklik
if(isset($_POST['bsimpan'])){


  //pengujian apakah data akan diedit atau disimpan baru
  if(isset($_GET['hal']) == "edit"){
    $edit = mysqli_query($koneksi, "UPDATE tbarang SET 
                                           nama = '$_POST[tnama]',
                                           asal = '$_POST[tasal]',
                                            jumlah = '$_POST[tjumlah]',
                                             satuan = '$_POST[tsatuan]',
                                            tanggal_diterima = '$_POST[ttanggal_diterima]'
                                            WHERE id_barang = '$_GET[id]'
                                 ");

   //uji jika edit data sukses
   if($edit){
    echo "<script>
          alert('edit data sukses!');
          document.location='index.php';
        </script>";
  }else {
    echo "<script>
          alert('edit data gagal!');
          document.location='index.php';
        </script>";


  }
  }else{}
  

  //data akan disimpan baru
  $simpan = mysqli_query($koneksi, " INSERT INTO tbarang(kode, nama, asal, jumlah, satuan, tanggal_diterima)
                                                    VALUE ( '$_POST[tkode]',
                                                            '$_POST[tnama]',  
                                                            '$_POST[tasal]',
                                                            '$_POST[tjumlah]',
                                                            '$_POST[satuan]',
                                                            '$_POST[ttanggal_diterima]'
                                                     )
                                                 " );
  
  
  //uji jika simpan data sukses
  if($simpan){
    echo "<script>
          alert('simpan data sukses!');
          document.location='index.php';
        </script>";
  }else {
    echo "<script>
          alert('simpan data gagal!');
          document.location='index.php';
        </script>";


  }
}



//deklarasi variabel untuk menampung data yang akan diedit
$vkode = "";
$vnama = "";
$vasal = "";
$vjumlah = "";
$vsatuan = "";
$vtanggal_diterima = "";



//pengujian jika tombol edit / hapus diklik
if (isset($_GET['hal'])){
}

//pengujian jika edit data
if (isset($_GET['hal']) && $_GET['hal'] =="edit") { 

  //tampilkan data yang diedit
$tampil = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang = '$_GET[id]' ");
  $data = mysqli_fetch_array($tampil);
  if($data){

    //jika data ditemukan,maka data ditampung kedalam variabel
    $vkode = $data['kode'];
    $vnama = $data['nama'];
    $vasal = $data['asal'];
    $vdata = $data['jumlah'];
    $vsatuan = $data['satuan'];
    $vtanggal_diterima = $data['tanggal_diterima'];
  


}

}



?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Watmah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
        <!-- awal container -->
        <div class="container">
            <h3 class="text-center">data penjualan</h3> 
            <h3 class="text-center">Barang elektronik</h3>

              <!-- awal row -->
            <div class="row">
                <!-- awal col -->
                <div class="col-md-8 mx-auto">
                    <!-- awal card-->
                <div class="card">
                <div class="card-header bg-info text-light">
                     Form Input Data Barang
         </div>
         <div class="card-body">
             <!-- awal form-->
             <form method="POST">
            <div class="mb-3">
                 <label class="form-label">Kode Barang</label>
                <input type="text" name="tkode" value="<?= $vkode ?>"class="form-control" 
                placeholder="Masukan Kode Barang">
                     
        </div>
        <div class="mb-3">
                 <label class="form-label">Nama Barang</label>
                <input type="text" name="tnama" value="<?= $vnama ?>"class="form-control" placeholder="Masukan Nama Barang">
                       
        </div>
        <div class="mb-3">
                 <label class="form-label">Asal Barang</label>
                 <select class="form-select" name="tasal">
                <option value="<?= $vasal ?>"><?= $vasal ?></option>
                 <option value="Pembelian">Pembelian</option>
                 <option value="Hibah">Hibah</option>
                 <option value="Sumbangan">Sumbangan</option>
                 <option value="Bantuan">bantuan</option>
                 
        </select>
        </div>

        <div class="row">
            <div class="col">
            <div class="mb-3">
                 <label class="form-label">Jumlah</label>
                <input type="number" name="tjumlah" value="<?= $vjumlah ?>"
                class="form-control" placeholder="Masukan Jumlah Barang">
                </div>     
             </div>            
      

        <div class="col">
            <div class="mb-3">
                 <label class="form-label">Satuan</label>
                 <select class="form-select" name="tsatuan">
                 <option value="<?= $satuan ?>"><?= $vsatuan ?></option>
                 <option value="Unit">Unit</option>
                 <option value="Kotak">Kotak</option>
                 <option value="Pcs">Pcs</option>
                 <option value="pak">Pak</option>
                  </select>
              </div>
        </div>

        <div class="col">
            <div class="mb-3">
                 <label class="form-label">Tanggal diterima</label>
                <input type="date" name="ttanggal_diterima" value="<?= $vtanggal_diterima ?>" class="form-control" 
                placeholder="Masukan Jumlah Barang">
          </div>              
        </div>


        <div class="text-center">
            <hr>
            <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
            <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
        </div>
       </div> 


            </form>
           <!-- akhir form--> 
             
        </div>
         <div class="card-footer bg-info">
           
         </div>
        </div>
        
          <!-- akhir card-->
            </div>
            <!-- akhir col -->
            </div>
            <!-- akhir row -->

         <!-- awal card-->
         <div class="card mt-3">
                <div class="card-header bg-info text-light">
                    Data Barang
         </div>
         <div class="card-body">
          <div class="col-md-6 md-6">
            <form method="POST">
            <div class="Input group mb-3">
              <input type="text" placeholder="Masukan kata kunci!">
              <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
              <button class="btn btn-danger" name="breset" type="submit">Reset</button>
              </div>
           </form>
          </div> 

            <table class="table table-striped table-hover table-bordered">
              <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Asal Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Diterima</th>
                <th>Aksi</th>
              </tr>
              <?php
                  //persiapan menampilkan data
                  $no = 1;
                  $query = "SELECT * FROM tbarang order by id_barang desc";
                  $tampil = mysqli_query($koneksi, $query);
                  while($data = mysqli_fetch_array($tampil)) :

                  ?>

              <tr>
                <td><?=$no++ ?></td>
                <td><?=$data['kode'] ?></td>
                <td><?=$data['nama'] ?></td>
                <td><?=$data['asal'] ?></td>
                <td><?=$data['jumlah'] ?> <?=$data['satuan']?></td>
                <td><?=$data['tanggal_diterima'] ?></td>
                <td>
                  <a href="index.php?hal=edit&id=<?= $data['id_barang']?>" class="btn btn-warning">Edit</a>
                  <a href="index.php?hal=hapus&id=<?= $data['id_barang']?>" class="btn btn-danger">Hapus</a>

                </td>
              </tr>
                  
              <?php endwhile; ?>

        

            </table>
             
             
        </div>
         <div class="card-footer bg-info">
           
         </div>
        </div>
          <!-- akhir card-->
           


     </div>
        <!-- akhir container -->
                    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>