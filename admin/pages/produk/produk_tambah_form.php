<?php include "../../../module/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
    <title>Admin - Produk</title>
</head>
<body>
    <?php include_once "navigasi_produk.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <h2 class="h2">Manajemen Produk</h2>
            </div>
        </div>
        <form action="proses_tambah_produk.php" method="post" enctype="multipart/form-data">
            <div class="row border py-2 mx-5">
                <h5 class="h5 text-center py-2">Tambah Produk Baru</h5>
                <div class="col-6">
                    <div class="row">
                        <label for="txtIDProduk" class="col-3 col-form-label text-start">
                            ID Produk: 
                        </label>
                        <div class="col-9 mb-1">
                            <input type="text" name="txtIDProduk" id="txtIDProduk" class="form-control">
                        </div>
                        <label for="txtNamaProduk" class="col-3 col-form-label text-start">
                            Nama Produk: 
                        </label>
                        <div class="col-9 mb-1">
                            <input type="text" name="txtNamaProduk" id="txtNamaProduk" class="form-control">
                        </div>
                        <label for="txtHargaProduk" class="col-3 col-form-label text-start">
                            Harga Produk: 
                        </label>
                        <div class="col-9 mb-1">
                            <input type="text" name="txtHargaProduk" id="txtHargaProduk" class="form-control">
                        </div>
                        <label for="slKategori" class="col-3 col-form-label text-start">
                            Kategori : 
                        </label>
                        <div class="col-9 mb-1">
                            <select name="slKategori" id="slKategori" class="form-select">
                                <?php 
                                    $resultKategori = mysqli_query($connection, "SELECT * FROM tb_kategori ORDER BY nama_kategori ASC");
                                    if(mysqli_num_rows($resultKategori) > 0){
                                        while($fetchKategori = mysqli_fetch_array($resultKategori)){
                                            $nama_kategori = $fetchKategori['nama_kategori'];
                                ?>
                                <option value="<?php echo $nama_kategori; ?>" name="optKategori"><?php echo $nama_kategori; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <label for="txtStok" class="col-3 col-form-label text-start">
                            Stok Produk: 
                        </label>
                        <div class="col-9 mb-1">
                            <input type="number" min="0" name="txtStok" id="txtStok" class="form-control">
                        </div>
                        <label for="txtUkuran" class="col-3 col-form-label text-start">
                            Ukuran : 
                        </label>
                        <div class="col-9 mb-1">
                            <input type="text" name="txtUkuran" id="txtUkuran" class="form-control">
                        </div>
                        <label for="txtDeskripsi" class="col-3 col-form-label text-start">
                            Deskripsi : 
                        </label>
                        <div class="col-9 mb-1">
                            <textarea name="txtDeskripsi" id="txtDeskripsi" cols="30" rows="6" style="resize:none;" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <img src="" id="imgProduk" name="fotoProduk" class="img-fluid rounded" style="width:100%; height:90%;">
                    <input type="file" name="locFotoProduk" id="locFotoProduk" accept=".jpg, .jpeg, .png" class="form-control my-1" placeholder="Max Size 5MB" onchange="postImage(this);"/>
                </div>
                <div class="row justify-content-center my-4">
                    <div class="col-2 d-grid">
                        <a href="produk_pages.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                    <div class="col-3 d-grid">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    
    <?php include_once "footer_produk.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function postImage(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#imgProduk')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
