<?php 
    include "../../../module/conn.php"; 
    error_reporting (E_ALL ^ E_NOTICE);
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reports Pages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body>
    <?php require_once "navigasi_reports.php";  ?>

    <div class="container pb-5">
        <div class="row mb-5 py-2 align-items center justify-content-between">
            <div class="col-12">
                <h2 class="h2">Reports Pages</h2>
            </div>
        </div>
        <!-- Export Berdasarkan Seluruh Transaksi -->
        <div class="row mb-3 px-5">
            <div class="col-12">
                <form action="export_transactions.php" method="post" name="formReportTransactions">
                    <div class="row align-items-center">
                        <div class="col-3 px-1 fs-5">
                            All Transactions On :
                        </div>
                        <div class="col-2 px-1">
                            <select name="slFilterBulan" id="slFilterBulan" class="form-select">
                            <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $monthIndex = date('m', mktime(0,0,0,$m));
                                    $monthName = date('F', mktime(0,0,0,$m));
                                    echo '<option value="'.$monthIndex.'" ';
                                    if ($monthName == date('F')){
                                        echo 'selected';
                                    }
                                    echo' >'.$monthName.'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-2 px-1">
                            <select name="slFilterTahun" id="slFilterTahun" class="form-select">
                                <?php
                                    $yearsNow = date('Y');
                                    $yearsStart = '2020';
                                    for($yearsNow; $yearsNow >= $yearsStart; $yearsNow--){
                                ?>
                                    <option value="<?php echo $yearsNow; ?>"><?php echo $yearsNow; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 px-1 d-grid">
                            <button type="submit" name="submitExportAllTransactions" id="submitExportAllTransactions" class="btn btn-outline-danger rounded-pill">
                                <i class="fas fa-file-export"></i>
                                Export To PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Of Export Berdasarkan Seluruh Transaksi -->

        <!-- Export Seluruh Produk Ke Excel -->
        <div class="row mb-3 px-5">
            <div class="col-12">
                <form action="export_products.php" method="post" name="formReportAllProducts">
                    <div class="row align-items-center">
                        <div class="col-3 px-1 fs-5">All Products By : </div>
                        <div class="col-4 px-1">
                            <select name="slFilterKategori" id="slFilterKategori" class="form-select">
                                <option value="all_category">All Category</option>
                                <?php 
                                    $getDataKategori = mysqli_query($connection, "SELECT * FROM tb_kategori");
                                    while($fetchDataKategori = mysqli_fetch_array($getDataKategori)){
                                        $nama_kategori = $fetchDataKategori['nama_kategori'];
                                ?>
                                        <option value="<?php echo $nama_kategori; ?>"><?php echo $nama_kategori; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 px-1 d-grid">
                            <button type="submit" name="submitExportAllProducts" id="submitExportAllProducts" class="btn btn-outline-success rounded-pill">
                                <i class="fas fa-file-export"></i>
                                Export To Excel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Of Export Berdasarkan Kategori Produk -->

        <!-- Export Seluruh Pelanggan -->
        <div class="row mb-5 px-5">
            <div class="col-12">
                <form action="export_customers.php" method="post" name="formReportAllCustomers">
                    <div class="row align-items-center">
                        <div class="col-3 px-1 fs-5">All Customers By : </div>
                        <div class="col-2 px-1">
                            <select name="slFilterCustomers" id="slFilterCustomers" class="form-select">
                                <option value="nama_lengkap">Nama Lengkap</option>
                                <option value="id_pelanggan">ID Pelanggan</option>
                                <option value="nomor_telepon">No Telepon</option>
                                <option value="email">Email</option>
                            </select>
                        </div>
                        <div class="col-2 px-1">
                            <select name="slFilterSortCustomer" id="slFilterSortCustomer" class="form-select" style="font-family:'FontAwesome', 'Roboto';">
                                <option value="ASC">
                                    &#xf882
                                    Ascending
                                </option>
                                <option value="DESC">
                                    &#xf881
                                    Descending
                                </option>
                            </select>
                        </div>
                        <div class="col-3 px-1 d-grid">
                            <button type="submit" name="submitExportAllCustomers" id="submitExportAllCustomers" class="btn btn-outline-info rounded-pill">
                                <i class="fas fa-file-export"></i>
                                Export To PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Of Export Seluruh Pelanggan -->
    </div>

    <?php require_once "footer_reports.php"; ?>
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>