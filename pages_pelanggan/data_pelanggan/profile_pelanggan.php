<?php 
    include "../../module/conn.php";
	
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
    <title>Profile Pelanggan</title>
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
							<li class="dropdown-item">
								<a href="profile_pelanggan.php" class="text-decoration-none">
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

    <!-- Profile Pelanggan -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7 mt-2 mb-5 border bg-light shadow-lg rounded-3 border">
                <div class="row">
                    <div class="col-12 py-2 text-center bg-primary text-white">
                        <h4 class="h2">Your Profile</h4>
                    </div>
                </div>
                
                
                <form action="proses_ubah_pelanggan.php" method="post">
                <?php 
                    $id_pelanggan = $SESSION_id_pelanggan;
                    $resultPelanggan = mysqli_query($connection, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
                    while($fetchPelanggan = mysqli_fetch_array($resultPelanggan)){
                        $nama_lengkap = $fetchPelanggan['nama_lengkap'];
                        $email = $fetchPelanggan['email'];
                        $password_akses = $fetchPelanggan['password_akses'];
                        $tanggal_lahir = $fetchPelanggan['tanggal_lahir'];
                        $alamat_lengkap = $fetchPelanggan['alamat_lengkap'];
                        $nama_bank = $fetchPelanggan['nama_bank'];
                        $no_rekening = $fetchPelanggan['nomor_rekening'];
						$nomor_telepon = $fetchPelanggan['nomor_telepon'];
                ?>
                
                    <div class="row py-2">
                        <div class="col-12 mb-3 text-center">
                            <input type="hidden" name="hiddenIDPelanggan" value="<?php echo $id_pelanggan; ?>">
                            <text class="fs-2 fw-3"><?php echo $id_pelanggan; ?></text>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="txtNamaLengkap" class="form-label">Nama Lengkap :</label>
                            <input type="text" class="form-control" name="txtNamaLengkap" id="txtNamaLengkap" value="<?php echo $nama_lengkap; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="dtTanggalLahir" class="form-label">Tanggal Lahir :</label>
                            <input type="date" class="form-control" name="dtTanggalLahir" id="dtTanggalLahir" value="<?php echo $tanggal_lahir; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="txtEmail" class="form-label">Email :</label>
                            <input type="email" class="form-control" name="txtEmail" id="txtEmail" value="<?php echo $email; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="txtPassword" class="form-label">Password :</label>
                            <input type="text" class="form-control" name="txtPassword" id="txtPassword" value="<?php echo $password_akses; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="txtNamaBank" class="form-label">Nama Bank :</label>
                            <select name="slNamaBank" id="slNamaBank" class="form-select">
                                <option value="<?php echo $nama_bank; ?>" style="background-color: #dc3545; color:fff;" selected>
                                    <?php echo $nama_bank; ?>
                                </option>
								<?php 
									$resultRekening = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
									if(mysqli_num_rows($resultRekening)){
										while($fetchRekening = mysqli_fetch_array($resultRekening)){
											$nama_bank_usaha = $fetchRekening['nama_bank_usaha'];
											$no_rekening_usaha = $fetchRekening['nomor_rekening_usaha'];
										
									?>
									<option value="<?php echo $nama_bank_usaha; ?>"><?php echo $nama_bank_usaha; ?></option>
									<?php 
										}
									}
								?>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="txtNoRekening" class="form-label">No Rekening :</label>
                            <input type="text" class="form-control" name="txtNoRekening" id="txtNoRekening" value="<?php echo $no_rekening; ?>">
                        </div>
                    </div>

					<div class="row">
						<div class="col-6 mb-3">
							<label for="txtNoRekening" class="form-label">No Telepon :</label>
                            <input type="text" class="form-control" name="txtNoTelepon" id="txtNoTelepon" value="<?php echo $nomor_telepon; ?>">
						</div>
						<div class="col-6 mb-3">

						</div>
					</div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="txtAlamat" class="form-label">Alamat Lengkap :</label>
                            <textarea name="txtAlamat" id="txtAlamat" cols="30" rows="4" class="form-control" style="resize:none;"><?php echo $alamat_lengkap; ?></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div class="col-4 mb-2 d-grid">
                            <a href="../index.php" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                        <div class="col-4 mb-2 d-grid">
                            <input type="submit" class="btn btn-primary" name="submitSave" id="submitSave" value="Update">
                        </div>
                    </div>
                    <?php
                    }
                ?>
                </form>
                
            </div>
        </div>
    </div>
    <!-- End Of Profile Pelanggan -->

    <!-- Footer Pages -->
    <div class="container-fluid bg-body py-2" style="background-image:linear-gradient(#ffffff, #b5c4ff);">  
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

				<div class="col-7 text-center">
					<i class="fas fa-envelope"></i>
						info@gmail.com
					&nbsp;
					<i class="fas fa-phone"></i>
						+62-851-5637-0127
					<br>
					<i class="fas fa-home"></i>
						Jl. Cempaka No.61, Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20125
				</div>
				<div class="col-2 text-center">
					<img src="../../img/icons/bca.svg" alt="" width="50px">
					|
					<img src="../../img/icons/bni.png" alt="" width="50px">
					|
					<img src="../../img/icons/mandiri.png" alt="" width="50px">
				</div>
			</div>
		</div>
	</div>
	<!-- End of Footer Pages -->
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>