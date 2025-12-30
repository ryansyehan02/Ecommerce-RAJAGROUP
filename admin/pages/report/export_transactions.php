<?php
    include_once('../../../module/conn.php');

    $filterBulan = $_POST['slFilterBulan'];
    $filterTahun = $_POST['slFilterTahun'];
    $month = date('F', mktime(0,0,0,$filterBulan));

    $nama_file = 'All Transactions From '.date("d F Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama_file; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body onload="PrintToPDF();">
    <div class="container-fluid px-5 bg-light">
        <?php
            $queryDataPerusahaan = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
            $fetchDataPerusahaan = mysqli_fetch_array($queryDataPerusahaan);
            $nama_usaha = $fetchDataPerusahaan['nama_usaha'];
            $alamat_usaha = $fetchDataPerusahaan['alamat_usaha'];
            $no_telepon_usaha = $fetchDataPerusahaan['no_telepon_usaha'];
            $email_usaha = $fetchDataPerusahaan['email_usaha'];
            $instagram_usaha = $fetchDataPerusahaan['instagram_usaha'];
        ?>
        <div class="row py-4 align-items-center">
            <div class="col-3 text-start">
                <h5 class="h5 fw-bold "><?php echo $nama_usaha; ?></h5>
                <span class="text-muted fs-6"><?php echo $alamat_usaha; ?></span>
                <span class="text-muted fs-6"><?php echo $email_usaha; ?></span> <br>
                <span class="text-muted fs-6">Telp: <?php echo $no_telepon_usaha; ?></span>
            </div>
            <div class="col-9 text-end">
                <h5 class="h5 text-muted">Laporan Transaksi Penjualan</h5>
                <span class="text-muted">Laporan Bulan : <?php echo date("F Y"); ?></span>
            </div>
        </div>
        <div class="row align-items-center text-muted fw-lighter fst-italic">
            <div class="col-6 text-start">
            <text class="text-muted">
                    Description : List Of All Transactions
                </text>
            </div>
            <div class="col-6 text-end">
                Printed On : <?php echo date("d F Y"); ?>
            </div>
        </div>
    </div>


    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center align-middle">#</th>
                <th scope="col" class="text-center align-middle">ID Transaksi</th>
                <th scope="col" class="text-center align-middle">Tanggal Transaksi</th>
                <th scope="col" class="text-center align-middle">Total Transaksi</th>
                <th scope="col" class="text-center align-middle">Status Transaksi</th>
                <th scope="col" class="text-center align-middle">Nomor Rekening</th>
                <th scope="col" class="text-center align-middle">Alamat Lengkap</th>
                <th scope="col" class="text-center align-middle">Layanan Pengiriman</th>
                <th scope="col" class="text-center align-middle">Nomor Resi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['submitExportAllTransactions'])){
                    $queryAllTransactions = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE MONTH(tanggal_transaksi) = '$filterBulan' AND YEAR(tanggal_transaksi) = '$filterTahun' ORDER BY tanggal_transaksi DESC");
                        $no = 0;
                        while($fetchAllTransactions = mysqli_fetch_array($queryAllTransactions)){
                            $no++;
                            $id_transaksi = $fetchAllTransactions['id_transaksi'];
                            $id_order = $fetchAllTransactions['id_order'];
                            $id_pelanggan = $fetchAllTransactions['id_pelanggan'];
                            $tanggal_transaksi = $fetchAllTransactions['tanggal_transaksi'];
                            $waktu_transaksi = $fetchAllTransactions['waktu_transaksi'];
                            $total_transaksi = number_format($fetchAllTransactions['total_transaksi'], 0,',','.');
                            $status_transaksi = $fetchAllTransactions['status_transaksi'];
                            $nomor_rekening_pelanggan = $fetchAllTransactions['nomor_rekening_pelanggan'];
                            // $bukti_pembayaran = $fetchAllTransactions['bukti_pembayaran'];
                            $kota_tujuan = $fetchAllTransactions['kota_tujuan'];
                            $alamat_lengkap = $fetchAllTransactions['alamat_lengkap'];
                            $kurir_pengiriman = $fetchAllTransactions['kurir_pengiriman'];
                            $berat_kiriman = $fetchAllTransactions['berat_kiriman'];
                            $layanan_pengiriman = $fetchAllTransactions['layanan_pengiriman'];
                            $tarif_pengiriman = number_format($fetchAllTransactions['tarif_pengiriman'], 0,',','.');
                            $estimasi_pengiriman = $fetchAllTransactions['estimasi_pengiriman'];
                            $nomor_resi_kurir = $fetchAllTransactions['nomor_resi_kurir'];
                            
            ?>
            <tr class="align-middle">
                <td class="text-center text-wrap" style="width:1rem;">
                    <?php echo $no; ?>
                </td>

                <td class="text-center text-wrap" style="width:2rem;">
                    <?php echo $id_transaksi; ?>
                </td>

                <td class="text-center text-wrap" style="width:7rem;">
                    <?php echo $tanggal_transaksi." ".$waktu_transaksi; ?>
                </td>

                <td class="text-center text-wrap" style="width:5rem;">
                    Rp.<?php echo $total_transaksi; ?>
                </td>

                <td class="text-center text-wrap" style="width:4rem;">
                    <?php echo $status_transaksi; ?>
                </td>

                <td class="text-center text-wrap" style="width:1rem;">
                    <?php echo $nomor_rekening_pelanggan; ?>
                </td>

                <td class="text-center text-wrap" style="width:20rem;">
                    <?php echo $kota_tujuan." - ".$alamat_lengkap; ?>
                </td>

                <td class="text-center text-wrap text-uppercase" style="width:6rem;">
                    <?php echo $kurir_pengiriman." - ".$layanan_pengiriman."<br>".$berat_kiriman."Kg <br> ".$estimasi_pengiriman."<br> Rp.".$tarif_pengiriman; ?>
                </td>

                <td class="text-center text-wrap" style="width:1rem;">
                    <?php echo $nomor_resi_kurir; ?>
                </td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <?php
                $querySumAllTransactions = mysqli_query($connection, "SELECT SUM(total_transaksi) AS sumTotalTransaksi, SUM(tarif_pengiriman) AS sumTarifPengiriman, COUNT(id_transaksi) AS countTransaksi FROM tb_transaksi WHERE MONTH(tanggal_transaksi) = '$filterBulan' AND YEAR(tanggal_transaksi) = '$filterTahun' ORDER BY id_transaksi ASC");
                $fetchSumAllTransactions = mysqli_fetch_array($querySumAllTransactions);
                
                $sumTotalTransaksi = $fetchSumAllTransactions['sumTotalTransaksi'];
                $sumTarifPengiriman = $fetchSumAllTransactions['sumTarifPengiriman'];
                $countTransaksi = $fetchSumAllTransactions['countTransaksi'];
                $netSales = $sumTotalTransaksi - $sumTarifPengiriman;
            ?>
            <tr>
                <td colspan="2" class="text-center fw-bold">
                    Total Transactions : <br>
                    <?php echo $countTransaksi; ?>x
                </td>

                <td colspan="4" class="text-end fw-bold">
                    Total Collected : &nbsp; &nbsp; Rp.<?php echo number_format($sumTotalTransaksi,0,',','.'); ?>
                </td>
                <td colspan="3" class="text-center fw-bold">
                    Net Sales : &nbsp; &nbsp; Rp.<?php echo number_format($netSales,0,',','.'); ?>
                </td>
            </tr>
        </tfoot>
    </table>
    </div>
    



    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function PrintToPDF(){
            var css = '@page {size: landscape, margin:none, scale:80}',
                head = document.head || document.GetElementsByName('head')[0],
                style = document.createElement('style');
            style.type = 'text/css';
            style.media = 'print';
            if(style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            window.print();
            window.onafterprint = function(event){
                window.location.href = 'report_pages.php';
            }
        }
    </script>
</body>
</html>