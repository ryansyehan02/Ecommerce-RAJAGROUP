<?php include "../../../module/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
    <title>Admin - Produk</title>
</head>
<body>
    <?php include_once "navigasi_produk.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-10 py-2">
                <h2 class="h2">Manajemen Produk</h2>
            </div>
            <div class="col-2 d-grid gap-2">
                <a href="produk_tambah_form.php" class="btn btn-primary align-self-center">Tambah</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-5 py-2 border overflow-auto" style="height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Foto Produk</th>
                            <th scope="col" class="text-center">ID Produk</th>
                            <th scope="col" class="text-start">Nama Produk</th>
                            <th scope="col" class="text-center">Stok</th>
                            <th scope="col" class="text-center">Ukuran</th>
                            <th scope="col" class="text-center">Harga Produk</th>
                            <th scope="col" class="text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        error_reporting (E_ALL ^ E_NOTICE);
                        $resultProduk = mysqli_query($connection, "SELECT * FROM tb_produk ORDER BY nama_produk ASC");
                        if(mysqli_num_rows($resultProduk) > 0){
                            while($fetchProduk = mysqli_fetch_array($resultProduk)){
                                $id_produk = $fetchProduk['id_produk'];
                                $nama_produk = $fetchProduk['nama_produk'];
                                $harga_produk = number_format($fetchProduk['harga_produk'], 0,',','.');
                                $kategori_produk = $fetchProduk['kategori_produk'];
                                $stok_produk = $fetchProduk['stok_produk'];
                                $ukuran_produk = $fetchProduk['ukuran_produk'];
                                $deskripsi_produk = $fetchProduk['deskripsi_produk'];
                                $gambar_produk = $fetchProduk['gambar_produk'];                            
                    ?>
                        <tr class="align-middle">
                            <td class="text-center">
                                <img src="../../../img/produk/<?php echo $gambar_produk; ?>" alt="" class="img-thumbnail" style="width:110px; height:110px;">
                            </td>
                            <td class="text-center">
                                <?php echo $id_produk; ?>
                            </td>
                            <td class="w-25">
                                <?php echo $nama_produk; ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    if($stok_produk <= 5){
                                        echo "<text class='text-danger'>$stok_produk pcs</text>";
                                    } else {
                                        echo $stok_produk." pcs"; 
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php echo $ukuran_produk; ?>
                            </td>
                            <td class="text-center text-primary">
                                Rp.<?php echo $harga_produk; ?>
                            </td>
                            <td class="text-center">
                                <a href="produk_detail_form.php?id_produk=<?php echo $id_produk; ?>" class="btn btn-outline-primary px-5">Detail</a>
                            </td>
                        </tr>
                    <?php 
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include_once "footer_produk.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>