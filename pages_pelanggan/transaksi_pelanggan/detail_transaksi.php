<?php 
	include_once "../../module/conn.php";
	session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
	$SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];
	include_once "../cart_pelanggan/generate_id_order.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../css/custom_css.css">
    <title>Detail Transaksi</title>
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
                My Transactions
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Transactions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- Transactions Detail Pelanggan -->
    <div class="container my-5">
        <div class="row justify-content-evenly">
            <div class="col-10 border" style="overflow-y:auto; height:600px;">
                <table class="table table-responsive align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-white sticky-top border-bottom">ID Transaksi</th>
                            <th scope="col" class="bg-white sticky-top border-bottom">Tanggal Transaksi</th>
                            <th scope="col" class="bg-white sticky-top border-bottom text-center">Total</th>
                            <th scope="col" class="bg-white sticky-top border-bottom text-center">Status</th>
                            <th scope="col" class="bg-white sticky-top border-bottom"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE id_pelanggan = '$SESSION_id_pelanggan' ORDER BY tanggal_transaksi DESC");
                            if(mysqli_num_rows($resultTransaksi) > 0){
                                while($fetchTransaksi = mysqli_fetch_array($resultTransaksi)){
                                    $id_transaksi = $fetchTransaksi['id_transaksi'];
                                    $tanggal_transaksi = $fetchTransaksi['tanggal_transaksi'];
                                    $waktu_transaksi = $fetchTransaksi['waktu_transaksi'];
                                    $total_transaksi = number_format($fetchTransaksi['total_transaksi'], 0,',','.');
                                    $status_transaksi = $fetchTransaksi['status_transaksi'];
                        ?>
                        <tr>
                            <td class="w-25">
                                <h5 class="h5">
                                    <?php echo $id_transaksi; ?>
                                </h5>
                            </td>
                            <td class="w-25">
                                <text class="fst-italic">
                                    <?php echo $tanggal_transaksi; ?>
                                    -
                                    <?php echo $waktu_transaksi; ?>
                                </text>
                            </td>
                            <td class="text-center">
                                Rp.<?php echo $total_transaksi; ?>
                            </td>
                            <td class="text-center">
                                <div class="col-12 d-grid">
                                <?php 
                                    if($status_transaksi == "Sedang Diproses"){
                                        echo "<text class='fw-bold btn btn-info'>Sedang Diproses</text>";
                                    } else if($status_transaksi == 'Dalam Pengiriman'){
                                        echo "<text class='fw-bold btn btn-warning'>Dalam Pengiriman</text>";
                                    } else if($status_transaksi == 'Sudah Diterima'){
                                        echo "<text class='fw-bold btn btn-success'>Sudah Diterima</text>";
                                    } else {
                                        echo "<text class='fw-bold btn btn-dark'>Sedang Dikonfirmasi</text>";
                                    }
                                ?>
                                </div>
                            </td>
                            <td class="d-grid">
                                <a href="detail_order_transaksi.php?id_transaksi=<?php echo $id_transaksi; ?>" class="btn btn-outline-primary">Details</a>
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
    <!-- End Of Transactions Detail Pelanggan -->





    <!-- Footer Pages -->
	<div class="container-fluid bg-body py-2 border-top" style="background-image:linear-gradient(#ffffff, #b5c4ff);">  
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