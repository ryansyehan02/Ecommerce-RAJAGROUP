<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Navigasi Header Dan Banner -->
	<div class="container-fluid justify-content-center">
		<div class="row py-2 px-5 align-items-center bg-body">
			<div class="col-2">
				<a href="index.php">
					<img src="../../../img/logo.png" alt="" class="img-fluid">
				</a>
			</div>
			<div class="col-8 gx-0">
				<h5 class="display-6 text-center">Admin Pages</h5>
				<nav class="navbar navbar-expand-lg bg-body">
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
							<ul class="navbar-nav">
								<li class="nav-item px-2">
									<a class="nav-link fs-5" aria-current="page" href="../dashboard_admin.php">
										<i class="fas fa-home"></i>
										Dashboard
									</a>
								</li>
								<li class="nav-item px-2">
									<a class="nav-link fs-5" href="transaksi_pages.php">
										<i class="fas fa-shopping-cart"></i>
										Transaksi
									</a>
								</li>
								<li class="nav-item px-2">
									<a class="nav-link fs-5" href="../kategori/kategori_pages.php">
										<i class="fas fa-filter"></i>
										Kategori
									</a>
								</li>
								<li class="nav-item px-2">
									<a class="nav-link fs-5" href="../produk/produk_pages.php">
										<i class="fas fa-tags"></i>
										Produk
									</a>
								</li>
								<li class="nav-item px-2">
									<a class="nav-link fs-5" href="../pelanggan/pelanggan_pages.php">
										<i class="fas fa-users"></i>
										Pelanggan
									</a>
								</li>
								<li class="nav-item px-2">
									<a class="nav-link fs-5" href="../report/report_pages.php">
										<i class="fas fa-file-pdf"></i>
										Reports
									</a>
								</li>
							</ul>
						</div>
				</nav>
			</div>
			<div class="col-2 text-danger">
				<i class="fas fa-user fa-2x align-middle"></i>
				<a href="../../logout_proses.php" class="text-danger fw-bold text-decoration-none align-middle">Sign Out</a>
			</div>
		</div>
	</div>

	
</body>
</html>