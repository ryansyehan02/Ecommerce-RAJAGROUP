<?php 
	include_once "../../module/conn.php";
	session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
	$SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];
	include_once "../cart_pelanggan/generate_id_order.php";

    
    $id_produk = $_GET['id_produk'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../css/custom_css.css">
    <title>Detail Products</title>
</head>
<body>
    <!-- Navigasi -->
	<div class="container-fluid">
		<div class="row py-3 px-5 justify-content-center bg-body">
			<div class="col-2">
					<a href="index.php">
					<img src="../../img/logo.png" alt="" class="img-fluid">
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
                <a href="../cart_pelanggan/detail_cart.php?id_order=<?php echo $id_order; ?>" type="button" class="btn btn-outline-primary border-0 px-1">
					<i class="fas fa-shopping-cart fa-2x align-middle"></i>
					<span class="badge bg-danger align-top">
					<?php 
							// id_order diambil dari file generate_id_order.php di baris paling atas halaman ini;							
							$getItemsInCart = mysqli_query($connection, "SELECT COUNT(id_order) AS countCart FROM tb_order WHERE id_order = '$id_order'");
							$fetchItemsInCart = mysqli_fetch_array($getItemsInCart);
							$itemsInCart = $fetchItemsInCart['countCart'];
						
							echo $itemsInCart;
                        ?>
					</span>
				</a>
			</div>
			<div class="col-3">
				<ul class="nav px-0">
					<li class="nav-item dropdown">
						<a href="" class="nav-link link-primary dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fas fa-user fa-2x align-middle text-primary"></i>
							<?php echo $SESSION_nama_pelanggan; ?>
						</a>
						<ul class="dropdown-menu ms-5">
							<li class="dropdown-item text-link">
								<a href="../data_pelanggan/profile_pelanggan.php" class="text-decoration-none">
									My Profile
								</a>
							</li>
                            <li class="dropdown-item text-link">
                                <a href="../transaksi_pelanggan/detail_transaksi.php" class="text-decoration-none">
                                    My Transactions
                                </a>
                            </li>
							<li><hr class="dropdown-divider"></li>
							<li class="dropdown-item text-link">
								<a href="../index.php" class="text-danger text-decoration-none">
									<i class="fas fa-power-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Of Navigasi -->

    <!-- Header -->
    <div class="container-fluid bg-light py-4">
        <div class="row justify-content-around">
            <div class="col-8 h3 fw-bold">
                Detail Products
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="produk_all.php">Products</a></li>
                        <li class="breadcrumb-item"><a href="produk_all.php">All Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- Detail Products -->
    <div class="container py-3">
        <?php 
            error_reporting (E_ALL ^ E_NOTICE);
            // Query SQL untuk menampilkan detail produk pada pages produk_detail.php
            $resultDetailProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk' AND stok_produk > 0");
            if(mysqli_num_rows($resultDetailProduk) > 0){
                while($fetchDetailProduk = mysqli_fetch_array($resultDetailProduk)){
                    $nama_produk = $fetchDetailProduk['nama_produk'];
                    $harga_produk = number_format($fetchDetailProduk['harga_produk'], 0,',','.');
                    $stok_produk = $fetchDetailProduk['stok_produk'];
                    $ukuran_produk = $fetchDetailProduk['ukuran_produk'];
                    $deskripsi_produk = $fetchDetailProduk['deskripsi_produk'];
                    $gambar_produk = $fetchDetailProduk['gambar_produk'];
        ?>
        <div class="row rounded-3 shadow-lg my-5">
            <div class="col-2 align-self-center">
                <img src="../../img/produk/<?php echo $gambar_produk; ?>" class="img-fluid rounded-3" alt="">
            </div>
            <div class="col-8 align-self-center py-1">
                <h4 class="h4 text-dark fw-bold"><?php echo $nama_produk; ?></h4>
                <h4 class="h4 text-primary fw-bold">Rp.<?php echo $harga_produk; ?>,-</h4>
                <p class="text-muted fst-italic">Stok Tersedia : <?php echo $stok_produk; ?> pcs</p>
                <p class="text-dark truncate-teks"><?php echo $deskripsi_produk; ?></p>
                <p class="text-dark fw-bold">Ukuran Tersedia : <?php echo $ukuran_produk; ?></p>
            </div>
            <div class="col-2 d-grid align-self-center">
                <a href="" class="btn btn-primary text-white rounded-3 py-5" data-bs-toggle="modal" data-bs-target="#modalOrder">
                    <i class="fas fa-cart-plus fa-3x text-center"></i>
                    <br>
                    <text class="align-self-end h5">
                        Add To Cart
                    </text>
                </a>
            </div>
        </div>
        <!-- Modal Proses Order -->
        <div class="modal fade" id="modalOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalOrderLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="modalOrderLabel"><?php echo $nama_produk; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../cart_pelanggan/proses_order.php?id_produk=<?php echo $id_produk; ?>" method="post">
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <input type="number" name="txtUkuran" id="txtUkuran" class="form-control" placeholder="Ukuran Sepatu : <?php echo $ukuran_produk; ?>" min="30">
                        </div>
                        <div class="mb-3">
                            <input type="number" name="txtQuantity" id="txtQuantity" class="form-control" placeholder="Jumlah Produk" min="1">
                        </div>
                        <div class="row justify-content-evenly">
                            <div class="col-3 d-grid">
                                <a href="" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</a>
                            </div>
                            <div class="col-5 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-cart-plus fa-md"></i>
                                    Order
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- End Modal Proses Order -->
        <?php 
                }
            }
        ?>
    </div>
    <!-- End Of Detail Products -->

    <!-- Ini adalah bagian Upselling Product -->
    <div class="container mb-5">
        <div class="row border-bottom mb-4">
            <div class="col-12 text-center">
                <h4 class="h4">Produk Serupa</h4>
            </div>
        </div>
        <div class="row justify-content-evenly">
            <?php 
                $dataProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");
                $fetchProduk = mysqli_fetch_array($dataProduk);
                $data_nama_produk = $fetchProduk['nama_produk'];
                $data_harga_produk = $fetchProduk['harga_produk'];
                $data_ukuran_produk = $fetchProduk['ukuran_produk'];
                $data_kategori_produk = $fetchProduk['kategori_produk'];
                

                // Ini adalah query untuk bagian upselling, menyesuaikan dari harga produk yang lebih mahal dan kategori produk yang sama dengan produk yang dipilih pelanggan namun ditampilkan secara Random pada Web nantinya
                $resultUpselling = mysqli_query($connection, "SELECT * FROM tb_produk WHERE harga_produk > '$data_harga_produk' AND kategori_produk = '$data_kategori_produk' ORDER BY RAND() LIMIT 4");
                if(mysqli_num_rows($resultUpselling) > 0){
                    while($fetchUpselling = mysqli_fetch_array($resultUpselling)){
                        $upsell_id_produk = $fetchUpselling['id_produk'];
                        $upsell_harga_produk = number_format($fetchUpselling['harga_produk'], 0,',','.');
            ?>
            <div class="card rounded-3 shadow" style="width: 16rem; height:28rem;">
                <img src="../../img/produk/<?php echo $fetchUpselling['gambar_produk']; ?>" class="card-img-top" height="250px" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold truncate-teks"><?php echo $fetchUpselling['nama_produk']; ?></h5>
                    <p class="card-text fw-bold text-primary">
                        Rp.<?php echo $upsell_harga_produk; ?>
                    </p>
                    
                </div>
                <div class="card-footer bg-transparent text-end">
                    <a href="produk_detail.php?id_produk=<?php echo $upsell_id_produk; ?>" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Lihat Produk
                    </a>
                </div>
            </div>

            <?php
                    }
                } 
                else {
                    //Bagian Ini adalah jika Product Yang Dipilih Pelanggan Merupakan Produk Yang Paling Terbaik, Namun Teknik Upselling akan tetap jalan untuk menawarkan produk produk lainnya yang sesuai dengan pilihan Customers
                    
                    $resultUpselling2 = mysqli_query($connection, "SELECT * FROM tb_produk WHERE kategori_produk = '$data_kategori_produk' ORDER BY RAND() LIMIT 4");
                    while($fetchUpselling2 = mysqli_fetch_array($resultUpselling2)){
                        $upsell2_id_produk = $fetchUpselling2['id_produk'];
                        $upsell2_harga_produk = number_format($fetchUpselling2['harga_produk'], 0,',','.');
            ?>
            <div class="card rounded-3 shadow" style="width: 16rem; height:28rem;">
                <img src="../../img/produk/<?php echo $fetchUpselling2['gambar_produk']; ?>" class="card-img-top" height="250px" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold truncate-teks"><?php echo $fetchUpselling2['nama_produk']; ?></h5>
                    <p class="card-text fw-bold text-primary">
                        Rp.<?php echo $upsell2_harga_produk; ?>
                    </p>
                    
                </div>
                <div class="card-footer bg-transparent text-end">
                    <a href="produk_detail.php?id_produk=<?php echo $upsell2_id_produk; ?>" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Lihat Produk
                    </a>
                </div>
            </div>
            <?php
                    }
                    // echo "Produk Yang Kamu Pilih Adalah Produk Yang Paling Terbaik Yang Kami Miliki <br>";
                }
            ?>
        </div>
    </div>
    <!-- End Of Upselling Product -->
    

    <!-- Footer -->
    <?php include_once "footer.php"; ?>
    <!-- End Of Footer -->





    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>