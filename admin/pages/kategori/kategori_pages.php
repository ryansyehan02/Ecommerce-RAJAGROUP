<?php include "../../../module/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
    <title>Admin - Kategori</title>
</head>
<body>
    <?php include_once "navigasi_kategori.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-10 py-2">
                <h2 class="h2">Manajemen Kategori</h2>
            </div>
            <div class="col-2 d-grid gap-2">
                <a href="kategori_tambah_form.php" class="btn btn-primary align-self-center">Tambah</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-5 py-2 border overflow-auto" style="height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID Kategori</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        error_reporting (E_ALL ^ E_NOTICE);
                        $resultKategori = mysqli_query($connection, "SELECT * FROM tb_kategori ORDER BY nama_kategori ASC");
                        if(mysqli_num_rows($resultKategori) > 0){
                            while($fetchKategori = mysqli_fetch_array($resultKategori)){
                                $id_kategori = $fetchKategori['id_kategori'];
                                $nama_kategori = $fetchKategori['nama_kategori'];

                                $resultProdukDalamKategori = mysqli_query($connection, "SELECT COUNT(kategori_produk) AS kategori_produk FROM tb_produk WHERE kategori_produk = '$nama_kategori'");
                                while($fetchProdukDalamKategori = mysqli_fetch_array($resultProdukDalamKategori)){
                                    $totalProdukDalamKategori = $fetchProdukDalamKategori['kategori_produk'];
                                }
                            
                    ?>
                        <tr class="align-middle">
                            <td class="">
                                <?php echo $id_kategori; ?>
                            </td>
                            <td class="">
                                <?php echo $nama_kategori; ?>
                            </td>
                            <td class="align-center">
                                <?php echo $totalProdukDalamKategori; ?> items
                            </td>
                            <td class="d-grid gap-2">
                                <a href="kategori_detail_form.php?id_kategori=<?php echo $id_kategori; ?>" class="btn btn-outline-primary px-3">Detail</a>
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
    <?php include_once "footer_kategori.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>