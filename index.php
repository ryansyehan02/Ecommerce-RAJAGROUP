<?php 
	include_once "module/conn.php"; 
	include "login_pelanggan.php";
	include "register_pelanggan.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-Commerce Putri</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="css/custom_css.css">
	
</head>
<body class="bg-light">
	<!-- Navigasi -->
	<div class="container-fluid">
		<div class="row py-3 px-5 justify-content-center ">
			<div class="col-2 align-items-center">
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

	<!-- Header And Banner -->
	<div class="container-fluid bg-light border-bottom">
		<div class="row justify-content-around align-items-start">
			<div class="col-1"></div>
			<div class="col-2">
				<ul class="nav flex-column">
					<li class="nav-item border-bottom text-center py-2 h5">
						CATEGORIES
					</li>
					<?php 
						$resultKategori = mysqli_query($connection, "SELECT * FROM tb_kategori ORDER BY RAND() LIMIT 10");
						if(mysqli_num_rows($resultKategori) > 0){
							while($fetchKategori = mysqli_fetch_array($resultKategori)){
								$nama_kategori = $fetchKategori['nama_kategori'];
								$id_kategori = $fetchKategori['id_kategori'];
					?>
						<li class="nav-item bg-body border rounded-3 mb-1">
							<a href="index_kategori.php?id_kategori=<?php echo $id_kategori; ?>" class="nav-link">
								<i class="fas fa-bookmark"></i>
								<?php echo $nama_kategori; ?>
							</a>
						</li>
					<?php
							}
						}
					?>
					
					<li class="nav-items bg-body border dropdown dropend text-center">
						<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
						More Items
						</a>
						<ul class="dropdown-menu">
							<?php 
								$resultMoreKategori = mysqli_query($connection, "SELECT * FROM tb_kategori ORDER BY nama_kategori");
								if(mysqli_num_rows($resultMoreKategori) > 0){
									while($fetchMoreKategori = mysqli_fetch_array($resultMoreKategori)){
										$more_nama_kategori = $fetchMoreKategori['nama_kategori'];
										$more_id_kategori = $fetchMoreKategori['id_kategori'];
							?>
							<li class="dropdown-item">
								<a href="index_kategori.php?id_kategori=<?php echo $more_id_kategori; ?>" class="nav-link">
									<i class="far fa-dot-circle"></i>
									<?php echo $more_nama_kategori; ?>
								</a>
							</li>
							<?php
									}
								}
							?>
						</ul>
					</li>
				</ul>
			</div>
			<div class="col-9 px-2 bg-dark" style="min-height:500px; background-image:url('img/banner.png'); background-size:100% 100%; background-repeat:no-repeat;">
				<!-- <img src="img/banner.png" class="img-fluid w-100" style="z-index:1" alt=""> -->
			</div>
		</div>
	</div>
	<!-- End Of Header And Banner-->

	<!-- Popular Products -->
	<div class="container my-1 py-5">
		<div class="row">
			<div class="row">
				<div class="col-12">
					<h1 class="h3 text-primary">
						<i class="far fa-star"></i>
						Popular Products
					</h1>
				</div>
			</div>
			<div class="row justify-content-evenly border-bottom">
			<?php 
				error_reporting (E_ALL ^ E_NOTICE);
				// Menghitung Popular Produk Terjual sesuai dengan ID Produk Pada Tabel Order dan Hitung Quantity Terjual Produknya
				$resultPopularProducts = mysqli_query($connection, "SELECT id_produk, SUM(quantity_produk) AS total_sell, nama_produk FROM tb_order GROUP BY id_produk ORDER BY SUM(quantity_produk) DESC LIMIT 4");
				if(mysqli_num_rows($resultPopularProducts) > 0){
					while($fetchPopularProduk = mysqli_fetch_array($resultPopularProducts)){
						$popular_id_produk = $fetchPopularProduk['id_produk'];
						$popular_count_produk = $fetchPopularProduk['total_sell'];
						
						// Ambil Data Dari Tabel Produk Untuk Mendapatkan Detail Produk Sesuai Dengan ID Produk Dari Tabel Order
						$resultDetailProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$popular_id_produk' AND stok_produk >= 1");
						while($fetchDetailProduk = mysqli_fetch_array($resultDetailProduk)){
							$detail_id_produk = $fetchDetailProduk['id_produk'];
							$detail_nama_produk = $fetchDetailProduk['nama_produk'];
							$detail_gambar_produk = $fetchDetailProduk['gambar_produk'];
							$detail_deskripsi_produk = $fetchDetailProduk['deskripsi_produk'];
							$detail_harga_produk = number_format($fetchDetailProduk['harga_produk'], 0,',','.');
							
			?>
				<div class="card rounded shadow mx-3 my-5" style="width:18rem; height:32rem;">
					<img src="img/produk/<?php echo $detail_gambar_produk; ?>" class="card-img-bottom shadow" style="width:100%; height:250px;">
					<div class="card-body px-1 text-start">
						<h5 class="card-title text-center">
							<a href="" class="link-dark" data-bs-toggle="modal" data-bs-target="#modalLogin">
								<?php echo $fetchDetailProduk['nama_produk']; ?>
							</a>
						</h5>
						<text class="card-text text-muted truncate-teks">
							<?php echo $detail_deskripsi_produk; ?>
						</text>
					</div>
					
					<div class="card-footer border h4 text-center fw-bold bg-light shadow rounded-3 border-white">
						Rp.<?php echo $detail_harga_produk; ?>
					</div>

					<div class="card-footer bg-transparent">
						<div class="row align-items-center">
							<div class="col-5 text-primary">
								<i class="fas fa-shopping-bag"></i>
								<?php echo $popular_count_produk; ?> Terjual
							</div>
							<div class="col-7 d-grid">
								<a href="index_produkdetail.php?id_produk=<?php echo $detail_id_produk; ?>" class="btn btn-sm p-2 btn-outline-danger fw-bold">
								<i class="fas fa-cart-plus fa-lg"></i>
								Add To Cart
								</a>
							</div>
						</div>
						
					</div>
				</div>
				
			<?php 
						}

					}
				}
			?>
			</div>
		</div>
	</div>
	<!-- End Of Popular Products -->

	<!-- All Products Random -->
	<div class="container my-5">
		<div class="row">
			<div class="row justify-content-center px-0">
				<div class="col-10">
					<h1 class="h3 text-primary">
						<i class="fas fa-store-alt"></i>
						All Products
					
					</h1>
				</div>
				<div class="col-2 d-grid align-items-center">
					<a href="index_produkall.php" class="btn btn-outline-primary h3"> 
						See All
						<i class="fas fa-chevron-right"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="row justify-content-evenly">
			<?php 
				error_reporting (E_ALL ^ E_NOTICE);
				$resultProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE stok_produk >= 1 ORDER BY RAND() LIMIT 10");
				
				if(mysqli_num_rows($resultProduk) > 0){
					while($fetchProduk = mysqli_fetch_array($resultProduk)){
						$data_id_produk = $fetchProduk['id_produk'];
						$hargaProduk = number_format($fetchProduk['harga_produk'], 0,',','.');
						$resultProdukSold = mysqli_query($connection, "SELECT COUNT(id_produk) AS countSold FROM tb_order WHERE id_produk = '$fetchProduk[id_produk]'");
						$fetchProdukSold = mysqli_fetch_array($resultProdukSold);
			?>

			<div class="card rounded shadow mx-1 my-3" style="width:16rem;">
				<img src="img/produk/<?php echo $fetchProduk['gambar_produk'];?>" class="card-img-top" height="250px" alt="...">
				<div class="card-body px-1 text-end">
					<h5 class="card-title text-start">
						<a href="" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalLogin">
							<?php echo $fetchProduk['nama_produk']; ?>
						</a>
					</h5>
					<p class="card-text text-start text-muted">
						Rp.<?php echo $hargaProduk; ?>,- 						
					</p>
				</div>
				<div class="card-footer bg-transparent align-items-center fs-6 fst-italic text-muted">
					<div class="row align-items-center">
						<div class="col-6">
							<i class="fas fa-shopping-bag"></i>
							<?php echo $fetchProdukSold['countSold']; ?> terjual
						</div>
						<div class="col-6 d-grid px-0">
							<a href="" class="btn btn-sm p-2 btn-outline-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin">
								<i class="fas fa-cart-plus fa-lg"></i> Add
							</a>
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
	<!-- End Of All Products Random -->

	<!-- Footer Pages -->
	<?php include_once "footer.php"; ?>
	<!-- End of Footer Pages -->
	<script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>