<?php 
	include_once "module/conn.php";
    include "login_pelanggan.php";
	include "register_pelanggan.php";
	
    $get_idKategori = $_GET['id_kategori'];
    $resultKategori = mysqli_query($connection, "SELECT * FROM tb_kategori WHERE id_kategori = '$get_idKategori'");
    $fetchKategori = mysqli_fetch_array($resultKategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="css/custom_css.css">
    <title>Best Products</title>
</head>
<body>
    <!-- Navigasi -->
	<div class="container-fluid">
		<div class="row py-3 px-5 justify-content-center bg-body">
			<div class="col-2">
					<a href="index.php">
					<img src="img/logo.png" alt="" class="img-fluid">
				</a>
			</div>
			<div class="col-6 gx-0">
				<form action="">
					<div class="input-group">
						<input type="text" name="txtSearch" id="txtSearch" class="form-control" placeholder="Search..">
						<span class="input-group-text btn btn-primary">
							<button type="submit" class="btn btn-sm">
								<i class="fas fa-search fa-lg text-white"></i>
							</button>
						</span>
					</div>
				</form>
			</div>
			<div class="col-1">
				<a href="" type="button" class="btn btn-outline-primary border-0 px-1" data-bs-toggle="modal" data-bs-target="#modalLogin">
					<i class="fas fa-shopping-cart fa-2x align-middle"></i>
					<span class="badge bg-danger align-top">0</span>
				</a>
			</div>
			<div class="col-3 align-middle py-1">
				<i class="fas fa-user fa-2x align-middle text-primary"></i>
				<a href="" class="text-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalLogin">Sign In</a>
					|
				<a href="" class="text-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalRegister">Register</a>
			</div>
		</div>
	</div>
	<!-- End Of Navigasi -->

    <!-- Header -->
    <div class="container-fluid bg-light py-4">
        <div class="row justify-content-around">
            <div class="col-8 h3 fw-bold">
            Category Of : <text class="text-primary"><?php echo $fetchKategori['nama_kategori'];?></text>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $fetchKategori['nama_kategori']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- All Popular Products -->
    <div class="container-fluid py-3">
        <div class="row justify-content-around">
            <div class="col-8 border py-4" style="overflow:auto; height:800px;">
            <?php 
				error_reporting (E_ALL ^ E_NOTICE);
                $nama_kategori = $fetchKategori['nama_kategori'];
				$resultProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE kategori_produk = '$nama_kategori' AND stok_produk >= 1 ORDER BY RAND()");
                if(mysqli_num_rows($resultKategori) > 0){
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
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-3 p-2" style="overflow:hidden;">
                            <img src="img/produk/<?php echo $gambar_produk; ?>" class="img-fluid">
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <h4 class="card-title h3 fw-bold"><?php echo $nama_produk; ?></h4>
                                <p class="card-text text-muted truncate-teks">
                                    <?php echo $deskripsi_produk; ?>
                                </p>
                                <p class="card-text text-muted">
                                    Stok Tersedia : <?php echo $stok_produk;?>pcs
                                </p>
                            </div>
                        </div>
                        <div class="col-2 border">
                            <div class="row py-5">
                                <div class="col-12 text-center text-danger h5 fw-bold">
                                    Rp.<?php echo $harga_produk; ?>
                                </div>
                            </div>
                            <div class="row px-2 ">
                                <div class="col-12 d-grid">
                                    <a href="index_produkdetail.php?id_produk=<?php echo $id_produk; ?>" class="btn btn-outline-primary py-2 mb-1">
                                        <i class="fas fa-info-circle"></i>
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
					}
				}
			?>    
            </div>
        </div>
    </div>
    <!-- End Of All Popular Products -->
    
    <!-- Footer -->
    <?php include_once "footer.php"; ?>
    <!-- End Of Footer -->
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>