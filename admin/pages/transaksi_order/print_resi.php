<?php 
    include_once("../../../module/conn.php");
    $id_transaksi = $_GET['id_transaksi'];
    
    $queryPrintTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
    $fetchPrintTransaksi = mysqli_fetch_array($queryPrintTransaksi);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Resi <?php echo $id_transaksi; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body onload="PrintResi();" class="" style="width148mm; height:210mm;">
    <div class="container-fluid px-5">
    <?php
            $queryDataPerusahaan = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
            $fetchDataPerusahaan = mysqli_fetch_array($queryDataPerusahaan);
            $nama_usaha = $fetchDataPerusahaan['nama_usaha'];
            $alamat_usaha = $fetchDataPerusahaan['alamat_usaha'];
            $no_telepon_usaha = $fetchDataPerusahaan['no_telepon_usaha'];
            $email_usaha = $fetchDataPerusahaan['email_usaha'];
            $instagram_usaha = $fetchDataPerusahaan['instagram_usaha'];

            $queryDataTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
            $fetchDataTransaksi = mysqli_fetch_array($queryDataTransaksi);
            $id_order = $fetchDataTransaksi['id_order'];
            $id_pelanggan = $fetchDataTransaksi['id_pelanggan'];
            $kurir_pengiriman = $fetchDataTransaksi['kurir_pengiriman'];
            $layanan_pengiriman = $fetchDataTransaksi['layanan_pengiriman'];
            $tarif_pengiriman = $fetchDataTransaksi['tarif_pengiriman'];
            $nomor_resi_kurir = $fetchDataTransaksi['nomor_resi_kurir'];
            $berat_kiriman = $fetchDataTransaksi['berat_kiriman'];
            $kota_tujuan = $fetchDataTransaksi['kota_tujuan'];
            $total_transaksi = $fetchDataTransaksi['total_transaksi'];
            if($kurir_pengiriman == 'jne'){
                $srcLogoKurir = 'jne';
            } else if($kurir_pengiriman == 'pos'){
                $srcLogoKurir = 'pos indonesia';
            } else if($kurir_pengiriman == 'tiki'){
                $srcLogoKurir = 'tiki';
            } else {
                $srcLogoKurir = '';
            }

            $queryDataPelanggan = mysqli_query($connection, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
            $fetchDataPelanggan = mysqli_fetch_array($queryDataPelanggan);
            $nama_lengkap = $fetchDataPelanggan['nama_lengkap'];
            $alamat_lengkap = $fetchDataPelanggan['alamat_lengkap'];
            $nomor_telepon = $fetchDataPelanggan['nomor_telepon'];
            
        ?>
        <div class="row py-2 align-items-center border-bottom">
            <div class="col-12 text-center">
                <h5 class="h5 fw-bold "><?php echo $nama_usaha; ?></h5>
                <span class="text-muted fs-6"><?php echo $alamat_usaha; ?></span>
                <span class="text-muted fs-6"><?php echo $email_usaha; ?></span> <br>
                <span class="text-muted fs-6">
                    Instagram :
                    <?php echo "@".$instagram_usaha; ?>
                </span>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12 text-center">
                <span class="text-uppercase fw-bold">
                    Label Pengiriman
                </span>
                <br>
                <span class="text-muted">Kode Transaksi : </span>
                <span><?php echo $id_transaksi; ?></span>
            </div>
        </div>
        <div class="row align-items-center py-3">
            <div class="col-2 text-center">
                <img src="../../../img/<?php echo $srcLogoKurir; ?>.png" alt="" class="img-thumbnail border-0 align-middle justify-content-center" style="height:3em;">
            </div>
            <div class="col-3">
                <span class="text-uppercase fw-bold">
                    <?php echo $kurir_pengiriman; ?>
                </span>
                <br>
                <span class="">
                    <?php echo $layanan_pengiriman; ?>
                </span>
            </div>
            <div class="col-2">
                <span class="text-uppercase fw-bold">
                    Berat
                </span>
                <br>
                <span class="">
                    <?php echo $berat_kiriman; ?> Kg
                </span>
            </div>
            <div class="col-2">
                <span class="text-uppercase fw-bold">
                    Tarif
                </span>
                <br>
                <span class="">
                    Rp.<?php echo number_format($tarif_pengiriman, 0,',','.'); ?>
                </span>
            </div>
            <div class="col-3">
                <span class="text-uppercase fw-bold">
                    Nomor Resi
                </span>
                <br>
                <span class="">
                    <?php echo $nomor_resi_kurir; ?>
                </span>
            </div>
        </div>
        <div class="row text-muted py-2">
            <div class="col-2">
                Penerima :
            </div>
            <div class="col-5">
                <?php echo $nama_lengkap." - ".$nomor_telepon; ?>
                <br>
                <?php echo $kota_tujuan ?>
            </div>
            <div class="col-5">
                <?php echo $alamat_lengkap; ?>
            </div>
        </div>
        
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Qty</th>
                        <th>Items</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Prices</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryDataOrder = mysqli_query($connection, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
                    if(mysqli_num_rows($queryDataOrder) > 0){
                        while($fetchDataOrder = mysqli_fetch_array($queryDataOrder)){
                            $nama_produk = $fetchDataOrder['nama_produk'];
                            $ukuran_produk = $fetchDataOrder['ukuran_produk'];
                            $quantity_produk = $fetchDataOrder['quantity_produk'];
                            $harga_produk = number_format($fetchDataOrder['harga_produk'], 0,',','.');
                            $subtotal_produk = number_format($fetchDataOrder['subtotal_produk'], 0,',','.');
                            
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $quantity_produk; ?>pcs</td>
                        <td><?php echo $nama_produk; ?></td>
                        <td class="text-center">Uk.<?php echo $ukuran_produk; ?></td>
                        <td class="text-center">Rp.<?php echo $harga_produk; ?></td>
                        <td class="text-center">Rp.<?php echo $subtotal_produk; ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">
                            Total : <br>
                        </td>
                        <td>Rp.<?php echo number_format($total_transaksi, 0,',','.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row py-3">
            <div class="col-12 text-start text-muted fst-italic fw-lighter">
                <small>
                Date Created : <?php echo date("d F Y"); ?>
                </small>
            </div>
        </div>
    </div>
    

    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function PrintResi(){
            var css = '@page {size:A6 portrait, margin:none, scale:80}',
                head = document.head || document.getElementsByName('head')[0],
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
                    window.location.href = 'transaksi_order_detail.php?id_order=<?php echo $id_order; ?>';
                }
        }

    </script>
</body>
</html>