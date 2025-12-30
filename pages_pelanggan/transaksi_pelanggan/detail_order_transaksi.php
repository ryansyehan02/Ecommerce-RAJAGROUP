<?php 
	include_once "../../module/conn.php";
	session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
	$SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];
	include_once "../cart_pelanggan/generate_id_order.php";
    $id_transaksi = $_GET['id_transaksi'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../css/custom_css.css">
    <title>Detail Order Transaksi</title>
</head>
<body>
    <!-- Navigasi -->
	<div class="container-fluid">
		<div class="row py-3 px-5 justify-content-center">
			<div class="col-2">
					<a href="../index.php">
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
                                <a href="detail_transaksi.php" class="text-decoration-none">
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
                My Transactions : 
                <!-- <text class="text-primary h4"></text> -->
				<a 
					href="https://wa.me/6285360091852?text=Halo%20Kak,%20Saya%20<?php echo $SESSION_nama_pelanggan; ?>,%20Mohon%20Informasi%20Transaksi%20Saya%20Dengan%20Kode%20Transaksi%20:%20*<?php echo $id_transaksi; ?>*%20" 
					target="_blank" 
					title="Klik Untuk Menghubungi Admin"
					class="text-primary h4">
                    <?php echo $id_transaksi; ?>
                </a>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Transactions</a></li>
                        <li class="breadcrumb-item"><a href="detail_transaksi.php">All Transactions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- Detail Orderan Transaksi Pelanggan -->
    <div class="container my-5">
        <div class="row align-items-center mb-2">
            <?php 
                $getDetailTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
                while($fetchDetailTransaksi = mysqli_fetch_array($getDetailTransaksi)){
                    $detail_id_order = $fetchDetailTransaksi['id_order'];
                    $detail_id_pelanggan = $fetchDetailTransaksi['id_pelanggan'];
                    $detail_total_transaksi = number_format($fetchDetailTransaksi['total_transaksi'], 0,',','.');

					// $detail_ongkir_transaksi = number_o
                    $detail_ongkir_transaksi = number_format($fetchDetailTransaksi['tarif_pengiriman'], 0,',','.');
                    
					$detail_status_transaksi = $fetchDetailTransaksi['status_transaksi'];
                    $detail_kurir_pengiriman = $fetchDetailTransaksi['kurir_pengiriman'];
					$detail_layanan_pengiriman = $fetchDetailTransaksi['layanan_pengiriman'];
                    $detail_tanggal_transaksi = $fetchDetailTransaksi['tanggal_transaksi'];
					$detail_nomor_resi_kurir = $fetchDetailTransaksi['nomor_resi_kurir'];
            ?>
            <div class="col-3 py-2 text-center">
                <text class="fw-bold">Status : </text>
                <?php 
                    if($detail_status_transaksi == "Sedang Diproses"){
                        echo "<text class='fw-bold text-info'>Sedang Diproses</text>";
                    } else if($detail_status_transaksi == 'Dalam Pengiriman'){
                        echo "<text class='fw-bold text-warning'>Dalam Pengiriman</text>";
                    } else if($detail_status_transaksi == 'Sudah Diterima'){
                        echo "<text class='fw-bold text-success'>Sudah Diterima</text>";
                    } else {
                        echo "<text class='fw-bold text-dark'>$detail_status_transaksi</text>";
                    }
                ?>
            </div>
            <div class="col-3 py-2 text-center">
                <text class="fw-bold">Tanggal Bayar : </text>
                <text class="text-muted"><?php echo $detail_tanggal_transaksi; ?></text>
            </div>
            <div class="col-3 py-2 text-start">
                <text class="fw-bold">Kurir : </text>
                <text class="text-muted text-uppercase">
                    <?php 
                        echo $detail_kurir_pengiriman;
                    ?>
                </text>
				<text class="text-muted text-uppercase">
					- <?php echo $detail_layanan_pengiriman; ?>
				</text>
				<text class="text-muted">
					| <?php echo "Rp.".$detail_ongkir_transaksi; ?>
				</text>
				<br>
				<text class="fw-bold">
					No. Resi : 
				</text>
				<text class="text-muted">
					<a href="https://www.cekpengiriman.com/cek-resi?resi=<?php echo $detail_nomor_resi_kurir; ?>&kurir=<?php echo $detail_kurir_pengiriman; ?>" target="_blank" class="text-decoration-none" title="Klik Untuk Melihat Perjalanan Pengiriman Anda">
						<?php echo $detail_nomor_resi_kurir; ?>
					</a>

				</text>
            </div>
            <div class="col-3 py-2 text-center">
                <text class="fw-bold">Total Bayar : </text>
                <text class="text-primary fw-bold">Rp.<?php echo $detail_total_transaksi; ?></text>
            </div>
            <?php
                }
            ?>
        </div>

        <div class="row">
            <div class="col-12 border" style="overflow-y: auto; height:500px;">
                <table class="table table-responsive table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-white sticky-top"></th>
                            <th scope="col" class="bg-white sticky-top text-center">Product Name</th>
							<th scope="col" class="bg-white sticky-top text-center">Ukuran </th>
                            <th scope="col" class="bg-white sticky-top text-center">Quantity</th>
                            <th scope="col" class="bg-white sticky-top text-center">Prices</th>
                            <th scope="col" class="bg-white sticky-top text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $getDataOrderan = mysqli_query($connection, "SELECT * FROM tb_order WHERE id_order = '$detail_id_order' AND id_pelanggan = '$detail_id_pelanggan'");
                            if(mysqli_num_rows($getDataOrderan)){
                                while($fetchDataOrderan = mysqli_fetch_array($getDataOrderan)){
                                    $id_produk = $fetchDataOrderan['id_produk'];
                                    $subtotal_produk = number_format($fetchDataOrderan['subtotal_produk'], 0,',','.');
                                    
                                    $getDataProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");
                                    while($fetchDataProduk = mysqli_fetch_array($getDataProduk)){
                                        $harga_produk = number_format($fetchDataProduk['harga_produk'], 0,',','.');
                                        $nama_produk = $fetchDataProduk['nama_produk'];
                                        $gambar_produk = $fetchDataProduk['gambar_produk'];
                                    }
                        ?>
                        <tr>
                            <td class="text-center">
                                <img src="../../img/produk/<?php echo $gambar_produk; ?>" class="img-fluid" style="max-height:120px; max-width:120px;">
                            </td>
                            <td class="w-25">
                                <?php echo $nama_produk; ?>
                            </td>
							<td class="text-center">
                                Uk.<?php echo $fetchDataOrderan['ukuran_produk']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $fetchDataOrderan['quantity_produk']; ?> pcs
                            </td>
                            <td class="text-center">
                                Rp.<?php echo $harga_produk; ?>
                            </td>
                            <td class="text-center">
                                Rp.<?php echo $subtotal_produk; ?>
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
    <!-- End Of Detail Orderan Transaksi Pelanggan -->

    <!-- Footer Pages -->
	<div class="container-fluid bg-body py-2 border-top">  
		<div class="row justify-content-center border-bottom">
			<div class="col-1"></div>
			<div class="col-2 py-3">
				<h6 class="h6 fw-bold">Brands</h6>
				<ul class="nav flex-column">
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Adidas</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Puma</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Rebook</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Geoff Max</a>
					</li>
				</ul>
			</div>
			<div class="col-2 py-3">
				<h6 class="h6 fw-bold">Company</h6>
				<ul class="nav flex-column">
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">About Us</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Career</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Find a store</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Rules & terms</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Sitemap</a>
					</li>
				</ul>
			</div>
			<div class="col-2 py-3">
				<h6 class="h6 fw-bold">Help</h6>
				<ul class="nav flex-column">
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Contact us</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Money refund</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Order status</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Shipping info</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Open dispute</a>
					</li>
				</ul>
			</div>
			<div class="col-2 py-3">
				<h6 class="h6 fw-bold">Account</h6>
				<ul class="nav flex-column">
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">User login</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">User register</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">Account setting</a>
					</li>
					<li class="nav-item py-1">
						<a href="" class="link-dark text-decoration-none">My orders</a>
					</li>
				</ul>
			</div>
			<div class="col-2 py-3">
				<h6 class="h6 fw-bold">Social</h6>
				<ul class="nav flex-column">
					<li class="nav-item py-1 justify-content-center">
						<a href="" class="link-dark text-decoration-none">
							<i class="fab fa-facebook"></i>
							Facebook
						</a>
					</li>
					<li class="nav-item py-1 justify-content-center">
						<a href="" class="link-dark text-decoration-none">
							<i class="fab fa-twitter"></i>
							Twitter
						</a>
					</li>
					<li class="nav-item py-1 justify-content-center">
						<a href="" class="link-dark text-decoration-none">
							<i class="fab fa-instagram"></i>
							Instagram
						</a>
					</li>
					<li class="nav-item py-1 justify-content-center">
						<a href="" class="link-dark text-decoration-none">
							<i class="fab fa-youtube"></i>
							Youtube
						</a>
					</li>
				</ul>
			</div>
			<div class="col-1"></div>
		</div>
		<div class="row px-2 py-3 text-muted align-items-center">
				<div class="col-3 text-center"> 
					&copy; 2021 E-Commerce
				</div>

				<div class="col-6 text-center">
					<i class="fas fa-envelope"></i>
						info@gmail.com
					&nbsp;
					<i class="fas fa-phone"></i>
						+62-851-5637-0127
					<br>
					<i class="fas fa-home"></i>
						Jl. Cempaka No.61, Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20125
				</div>
				<div class="col-3 text-center">
					<img src="../../img/icons/bca.svg" alt="" width="50px" height="18px">
					|
					<img src="../../img/icons/bni.png" alt="" width="50px" height="18px">
					|
					<img src="../../img/icons/mandiri.png" alt="" width="50px" height="18px">
					|
					<img src="../../img/icons/bri.png" alt="" width="50px" height="18px">
				</div>
			</div>
		</div>
	</div>
	<!-- End of Footer Pages -->
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>