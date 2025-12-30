<?php 
	include_once "../../module/conn.php";
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
    <style>
        #dashboard-page{
            background-image: url("../../img/banner admin 2.jpg");
            background-repeat:no-repeat;
            background-size: 100% 100%;
            /* background-position:center; */
            background-attachment:fixed;
            min-height: 700px;

        }
    </style>
	
</head>
<body class="bg-light">
    <!-- Navigasi Pages -->
    <?php include_once "navigasi.php"; ?>
    <!-- Ending Navigasi Pages -->


    <div class="container-fluid" id="dashboard-page">
        <div class="row py-5 text-center">
            <div class="col-12 py-5 my-5 align-middle text-uppercase">
                <div class="display-1 pb-3">
                    Welcome Admin
                </div>
                <div class="fs-5">
                    - this is your admin pages, to manage your E-Commerce Sites -
                </div>
            </div>
        </div>
        <div class="row align-items-center py-4 my-5 fs-6 text-center">
            <div class="col-4">
                <a href="https://www.rajagroupindonesia.com" target="_blank" class="link-dark text-decoration-none">
                <i class="fas fa-globe"></i>
                    WWW.RAJAGROUPINDONESIA.COM
                </a>
            </div>

            <div class="col-4">
                <a href="https://goo.gl/maps/nCUSu19ML7RXkAj59" target="_blank" class="link-dark text-decoration-none">
                    <i class="fas fa-map-marker-alt"></i>
                    Jl. Cempaka No.61A, Medan Helvetia
                </a>
            </div>

            <div class="col-4">
                <a href="" class="px-2 link-dark text-decoration-none">
                    <i class="fab fa-pinterest"></i>
                </a>
                <a href="https://www.instagram.com/RajaGroupIndonesia/" target="_blank" class="px-2 link-dark text-decoration-none">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="px-2 link-dark text-decoration-none">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- DASHBOARD PAGE -->
    <!-- <div class="container-fluid py-5 my-3">
        <div class="row my-5 py-5 justify-content-around" id="dashboard-page">
            <div class="col-6">
                <div class="display-3">
                    Welcome Admin
                </div>
                <div class="lead">
                    this is your admin pages, to manage your E-Commerce Sites
                </div>
            </div>
        </div>
    </div> -->
    <!-- END OF DASHBOARD PAGE -->
    

	<!-- Footer Pages -->
	<?php include_once "footer.php"; ?>
	<!-- End of Footer Pages -->
	<script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>