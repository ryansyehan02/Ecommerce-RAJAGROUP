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
    <title>Admin - Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body>
    <?php require_once "navigasi_transaksi.php";  ?>

    <div class="container">
        <div class="row mb-3 py-2 align-items-center justify-content-between">
            <div class="col-4">
                <h2 class="h2">Detail Transactions</h2>
            </div>
            <div class="col-6">
                <form action="transaksi_pages.php" method="post">
                    <div class="row align-items-center">
                        <div class="col-2 px-1 fw-bold">
                            Filter By :
                        </div>
                        <div class="col-3 px-1">
                            <select name="slFilterBulan" id="slFilterBulan" class="form-select">
                                <?php 
                                    for($m = 1; $m <= 12; $m++){
                                        $monthIndex = date('m', mktime(0,0,0,$m));
                                        $monthName = date('F', mktime(0,0,0,$m));
                                        echo '<option value="'.$monthIndex.'" ';
                                        if ($monthName == date('F')){
                                            echo 'selected';
                                        }
                                        echo' >'.$monthName.'</option>';
                                    }
                                ?>
                                <!-- <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option> -->
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
                        <div class="col-2 px-1 d-grid">
                            <input type="submit" value="Filter" name="submitFilter" id="submitFilter" class="btn btn-outline-primary rounded-pill">
                        </div>
                        <div class="col-2 px-1 d-grid">
                            <a href="transaksi_pages.php" class="btn btn-outline-secondary rounded-pill">Reset</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        <?php 
            if(isset($_POST['submitFilter'])){
                // Jika Filter Diaktifkan Maka Tampilkan Seluruh Data Transaksi Sesuai Dengan Tahun Dan Bulan Yang Dipilih
                $m = $_POST['slFilterBulan'];
                $y = $_POST['slFilterTahun'];
                $totalTransactions = mysqli_query($connection, "SELECT COUNT(id_transaksi) AS countTransaksi, SUM(total_transaksi) AS countCollectedTransaksi, tarif_pengiriman AS sumTarifPengiriman FROM tb_transaksi WHERE MONTH(tanggal_transaksi) = '$m' AND YEAR(tanggal_transaksi) = '$y' ORDER BY tanggal_transaksi DESC");
                $fetchTotalTransaksi = mysqli_fetch_array($totalTransactions);
                $countTransaksi = $fetchTotalTransaksi['countTransaksi'];
                $countCollected = number_format($fetchTotalTransaksi['countCollectedTransaksi'],0,',','.');
                $hitungNetSales = $fetchTotalTransaksi['countCollectedTransaksi'] - $fetchTotalTransaksi['sumTarifPengiriman'];
                $countNetSales = number_format($hitungNetSales,0,',','.');
                $resultTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE MONTH(tanggal_transaksi) = '$m' AND YEAR(tanggal_transaksi) = '$y' ORDER BY tanggal_transaksi DESC");
            } else {
                // Jika Filter Tidak Diaktifkan Maka Tampilkan Seluruh Data Transaksi
                $totalTransactions = mysqli_query($connection, "SELECT COUNT(id_transaksi) AS countTransaksi, SUM(total_transaksi) AS countCollectedTransaksi, SUM(subtotal_transaksi) AS countNetSales FROM tb_transaksi");
                
                $fetchTotalTransaksi = mysqli_fetch_array($totalTransactions);
                $countTransaksi = $fetchTotalTransaksi['countTransaksi'];
                $countCollected = number_format($fetchTotalTransaksi['countCollectedTransaksi'],0,',','.');
                $countNetSales = number_format($fetchTotalTransaksi['countNetSales'],0,',','.');
                $resultTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE MONTH(tanggal_transaksi) = '$m' AND YEAR(tanggal_transaksi) = '$y' ORDER BY tanggal_transaksi DESC");
            }
        ?>
        <div class="row justify-content-evenly mb-3 py-2 border-bottom">
            <div class="col-4 text-center">
                <h5 class="h5 text-muted">Total Transactions</h5>
                <text class="h5"><?php echo $countTransaksi; ?></text>
            </div>
            <div class="col-4 text-center border-start border-end">
                <h5 class="h5 text-muted">Total Collected</h5>
                <text class="h5">Rp.<?php echo $countCollected; ?></text>
            </div>
            <div class="col-4 text-center">
                <h5 class="h5 text-muted">Net Sales</h5>
                <text class="h5">Rp.<?php echo $countNetSales; ?></text>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-5 py-2 border overflow-auto" style="height:450px">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Transactions</th>
                            <th scope="col"></th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Total Prices</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(mysqli_num_rows($resultTransaksi) > 0){
                                while($fetchTransaksi = mysqli_fetch_array($resultTransaksi)){
                                    $kode_transaksi = $fetchTransaksi['id_transaksi'];
                                    $id_pelanggan = $fetchTransaksi['id_pelanggan'];
                                    $tanggal_transaksi = $fetchTransaksi['tanggal_transaksi'];
                                    
                                    // Fetching Data Pelanggan Untuk Ditampilkan Di Tabel Transaksi Sesuai dengan ID Pelanggan
                                    $resultPelanggan = mysqli_query($connection, "SELECT id_pelanggan, nama_lengkap FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
                                    while($fetchPelanggan = mysqli_fetch_array($resultPelanggan)){
                                        $nama_pelanggan = $fetchPelanggan['nama_lengkap'];
                                        
                                    };
                                    // End Fetch Data Pelanggan
                                    $total_prices = number_format($fetchTransaksi['total_transaksi'],0,',','.');
                                    $status_transaksi = $fetchTransaksi['status_transaksi'];
                        ?>
                        <tr class="align-middle">
                            <td class="">
                                <h6 class="h6">Kode Transaksi</h6>
                                <?php echo $kode_transaksi; ?>
                            </td>
                            <td class="w-25">
                               <h6 class="h6">Pelanggan</h6>
                                <?php echo $nama_pelanggan; ?>
                            </td>
                            <td class="w-25">
                                <?php echo $tanggal_transaksi; ?>
                            </td>
                            <td class="">
                                Rp.<?php echo $total_prices; ?>
                            </td>
                            <td class="w-25">
                                <?php 
                                    if($status_transaksi == "Sedang Diproses"){
                                        echo "<text class='fw-bold text-info'>Sedang Diproses</text>";
                                    } else if($status_transaksi == 'Dalam Pengiriman'){
                                        echo "<text class='fw-bold text-warning'>Dalam Pengiriman</text>";
                                    } else if($status_transaksi == 'Sudah Diterima'){
                                        echo "<text class='fw-bold text-success'>Sudah Diterima</text>";
                                    } else {
                                        echo "<text class='fw-bold text-dark'>Sedang Dikonfirmasi</text>";
                                    }
                                ?>
                            </td>
                            <td class="">
                                <a href="transaksi_order_detail.php?id_order=<?php echo $fetchTransaksi['id_order']; ?>" class="btn btn-outline-primary px-3">Details</a>
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

    <?php require_once "footer_transaksi.php"; ?>
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>