<?php 
    include "../../../module/conn.php"; 
    $id_order = $_GET['id_order'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body>
    <?php require_once "navigasi_transaksi.php";  ?>

    <div class="container py-3">
        <div class="row">
            <div class="col-12 py-2">
                <h2 class="h2">Detail Orders</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-7 py-2">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Prices</th>
                            <th scope="col" class="text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            error_reporting (E_ALL ^ E_NOTICE);
                            $resultOrder = mysqli_query($connection, "SELECT * FROM tb_order WHERE id_order = '$id_order' ORDER BY nama_produk");
                            if(mysqli_num_rows($resultOrder) > 0){
                                while($fetchOrder = mysqli_fetch_array($resultOrder)){
                                    $id_pelanggan = $fetchOrder['id_pelanggan'];
                                    $id_produk = $fetchOrder['id_produk'];
                                    $nama_produk = $fetchOrder['nama_produk'];
                                    $ukuran_produk = $fetchOrder['ukuran_produk'];
                                    $quantity = $fetchOrder['quantity_produk'];
                                    $harga_produk = number_format($fetchOrder['harga_produk'],0,',','.');

                                    // Ambil Kode Transaksi Pelanggan
                                    $dataTransaksi = mysqli_query($connection, "SELECT * FROM tb_transaksi WHERE id_order = '$id_order'");
                                    $fetchTransaksi = mysqli_fetch_assoc($dataTransaksi);
                                    // End Of Kode transaksi pelanggan

                                    // penghitungan total harga seluruh produk dalam order
                                    $sumHarga = mysqli_query($connection, "SELECT SUM(subtotal_produk) AS total FROM tb_order WHERE id_order = '$id_order'");
                                    $total_harga = mysqli_fetch_assoc($sumHarga);
                                    // end of penghitungan total harga

                                    // mencari data pelanggan menurut orderan
                                    $dataPelanggan = mysqli_query($connection, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'");
                                    $fetchPelanggan = mysqli_fetch_assoc($dataPelanggan);
                                    // end of data pelanggan

                                    // Mencari Data Produk
                                    $getGambarProduk = mysqli_query($connection, "SELECT gambar_produk FROM tb_produk WHERE id_produk = '$id_produk'");
                                    $fetchGambarProduk = mysqli_fetch_assoc($getGambarProduk);
                                    // End of mencari data produk
                        ?>
                        <tr class="align-middle">
                            <td class="">
                                <img src="../../../img/produk/<?php echo $fetchGambarProduk['gambar_produk']; ?>" alt="" class="img-thumbnail" style="width:80px; height:80px;">
                            </td>
                            <td class="">
                                <?php echo $nama_produk; ?>
                            </td>
                            <td class="">
                                <?php echo $quantity; ?>pcs
                            </td>
                            <td class="">
                                Rp.<?php echo $harga_produk; ?>
                                
                            </td>
                            <td class="text-center">
                                <?php
                                    if($fetchTransaksi['status_transaksi'] == 'Sudah Diterima' OR $fetchTransaksi['status_transaksi'] == 'Dalam Pengiriman'){
                                       echo "<text class='text-success'>$fetchTransaksi[status_transaksi]</text>";
                                    } else {
                                        echo "<a href='' class='btn btn-outline-danger py-2 px-2'>
                                                <i class='fas fa-trash'></i>
                                                Remove
                                            </a>";
                                    }
                                ?>
                                
                            </td>
                        </tr>
                        <?php 
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-5 py-2">
                <h6 class="h5">Payment & Confirmation</h6>
                <form action="proses_transaksi_order_detail.php" method="POST">
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Sub Total : </label>
                        <div class="col-sm-8 fw-bold">
                            Rp. <?php echo number_format($total_harga['total'],0,',','.'); ?>
                        </div>
                    </div>
                    
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Nama Bank : </label>
                        <div class="col-sm-8">
                            <input type="text" name="txtNamaBank" id="txtNamaBank" class="form-control form-control-sm" value="<?php echo $fetchPelanggan['nama_bank']; ?>" disabled>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">No Rekening : </label>
                        <div class="col-sm-8">
                            <input type="text" name="txtNoRekening" id="txtNoRekening" class="form-control form-control-sm" value="<?php echo $fetchPelanggan['nomor_rekening']; ?>" disabled>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Nama Pelanggan : </label>
                        <div class="col-sm-8">
                            <input type="text" name="txtNamaPelanggan" id="txtNamaPelanggan" class="form-control form-control-sm" value="<?php echo $fetchPelanggan['nama_lengkap']; ?>" disabled>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Nomor Telepon : </label>
                        <div class="col-sm-8 text-center">
                            <a href="https://wa.me/<?php echo $fetchPelanggan['nomor_telepon']; ?>?text=Halo%20Kak,%20Saya%20Admin%20E-Commerce%20CV%20Raja%20Group%20Indonesia" class="link-primary h6" target="_blank" title="WA Nomor Pelanggan"><?php echo $fetchPelanggan['nomor_telepon']; ?></a>
                        </div>
                    </div>
                    <div class="row mb-3 border-bottom pb-3">
                        <label for="" class="col-sm-4 col-form-label">Alamat <br> Pelanggan : </label>
                        <div class="col-sm-8 text-center">
                            <textarea name="txtAlamatPelanggan" id="txtAlamatPelanggan" cols="30" rows="5" class="form-control" style="resize:none;" disabled><?php echo $fetchPelanggan['alamat_lengkap']; ?></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Kode Transaksi : </label>
                        <div class="col-sm-8">
                            <input type="text" name="txtKodeTransaksi" id="txtKodeTransaksi" class="form-control form-control-sm" value="<?php echo $fetchTransaksi['id_transaksi']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="slStatus" class="col-sm-4 col-form-label">Status Transaksi : </label>
                        <div class="col-sm-8">
                        <select name="slStatus" id="slStatus" class="form-select">
                                <?php 
                                    // cek status Transaksi
                                    if($fetchTransaksi['status_transaksi'] == 'Sudah Diterima'){
                                        echo "<option value='$fetchTransaksi[status_transaksi]' class='bg-warning'>$fetchTransaksi[status_transaksi]</option>";
                                    } else {
                                ?>
                                <option value="Sedang Diproses">Sedang Diproses</option>
                                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                <option value="Sudah Diterima">Sudah Diterima</option>
                                <?php
                                    }
                                    // end of cek status transaksi
                                ?>
                                
                        </select>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Kurir Pengiriman : </label>
                        <div class="col-sm-8">
                            <input type="text" name="txtKurirPengiriman" id="txtKurirPengiriman" value="<?php echo $fetchTransaksi['kurir_pengiriman']." - ". $fetchTransaksi['layanan_pengiriman'] ." | Rp.".number_format($fetchTransaksi['tarif_pengiriman'],0,',','.'); ?>" class="form-control form-control-sm text-uppercase" disabled>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <label for="" class="col-sm-4 col-form-label">Total Bayar : </label>
                        <div class="col-sm-8 fw-bold fs-5">
                            Rp. <?php echo number_format($fetchTransaksi['total_transaksi'],0,',','.'); ?>
                        </div>
                    </div>

                    <div class="row align-items-center mb-4">
                        <label for="" class="col-sm-4 col-form-label">Nomor Resi <span class="text-uppercase"><?php echo $fetchTransaksi['kurir_pengiriman'] ?> : </span></label>
                        <div class="col-sm-8 fw-bold fs-5">
                            <?php 
                                if($fetchTransaksi['nomor_resi_kurir'] == null){
                            ?>
                                    <input type="text" name="txtNomorResiKurir" id="txtNomorResiKurir" class="form-control" maxlength="30" required>
                            <?php
                                } else {
                            ?>
                                    <input type="text" name="txtNomorResiKurir" id="txtNomorResiKurir" class="form-control" maxlength="30" required value="<?php echo $fetchTransaksi['nomor_resi_kurir']; ?>">
                            <?php 
                                } 
                            ?>
                            
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-12">
                            <h5 class="h5 text-center border-bottom">
                                Bukti Pembayaran
                            </h5>
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../../img/bukti_transaksi/<?php echo $fetchTransaksi['bukti_pembayaran']; ?>" id="imgBuktiBayar" name="fotoBuktiBayar" class="img-fluid rounded" style="width:100%; height:250px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center my-5">
                        <div class="col-2">
                            <a href="transaksi_pages.php" class="btn btn-outline-secondary">Home</a>
                        </div>
                        <div class="col-4">
                            <a href="print_resi.php?id_transaksi=<?php echo $fetchTransaksi['id_transaksi']; ?>" class="btn btn-outline-success">
                                <i class="fas fa-print"></i>
                                Print Resi
                            </a>
                        </div>
                        <div class="col-6 align-self-end d-grid gap-2">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fas fa-clipboard-check"></i>
                                Konfirmasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once "footer_transaksi.php"; ?>
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>