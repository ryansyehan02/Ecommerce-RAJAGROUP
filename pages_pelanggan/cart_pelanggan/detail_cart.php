<?php 
	include_once "../../module/conn.php";
	session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
	$SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];
    include_once "../cart_pelanggan/generate_id_order.php";
    include_once "../cart_pelanggan/generate_id_transaksi.php";
    
    $id_order = $_GET['id_order'];

    $id_pelanggan = $_SESSION['id_pelanggan'];
    $resultPelanggan = mysqli_query($connection, "SELECT alamat_lengkap FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    $fetchAlamatPelanggan = mysqli_fetch_array($resultPelanggan);

    // Hitung Berat Seluruh Produk Dalam Keranjang Belanja
    $resultCountCart = mysqli_query($connection, "SELECT SUM(quantity_produk) AS sumQuantity FROM tb_order WHERE id_order = '$id_order'");
    $fetchCountCart = mysqli_fetch_array($resultCountCart);
    
    // Cek Apakah Dalam Keranjang Belanja Ada Produknya atau Tidak | Jika Ada Total Berat Produk Dikurang 0.5Kg
    if($fetchCountCart['sumQuantity']){
        $berat_keranjang = $fetchCountCart['sumQuantity'] - 0.5;
    } else {
        $berat_keranjang = 0;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/custom_css.css">
    
    <title>Detail Cart</title>
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
                <form action="proses_transaksi.php" method="POST">
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
                <a href="" type="button" class="btn btn-outline-primary border-0 px-1">
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
                        <a href="" class="nav-link link-primary dropdown-toggle" data-bs-toggle="dropdown" role="button"
                            aria-expanded="false">
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
                                <a href="../transaksi_pelanggan/detail_transaksi.php" class="text-decoration-none">
                                    My Transactions
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
                Shopping Cart
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item">Orders</li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Of Header -->

    <!-- Order Detail On Cart -->
    <div class="container py-3 my-5">
        <div class="row justify-content-evenly">
            <div class="col-8" style="overflow-y:auto; height:900px;">
                <table class="table table-responsive align-middle">
                    <thead class="">
                        <tr>
                            <th scope="col" class="bg-white sticky-top border-bottom text-center">Product</th>
                            <th scope="col" class="bg-white sticky-top border-bottom"></th>
                            <th scope="col" class="bg-white sticky-top border-bottom">Prices</th>
                            <th scope="col" class="bg-white sticky-top border-bottom text-center">Quantity</th>
                            <th scope="col" class="bg-white sticky-top border-bottom text-center">Subtotal</th>
                            <th scope="col" class="bg-white sticky-top border-bottom"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $resultDetailOrder = mysqli_query($connection, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
                            if(mysqli_num_rows($resultDetailOrder) > 0){
                                while($fetchDetailOrder = mysqli_fetch_array($resultDetailOrder)){
                                    $detail_id_order = $fetchDetailOrder['id_order'];
                                    $detail_id_produk = $fetchDetailOrder['id_produk'];
                                    $detail_nama_produk = $fetchDetailOrder['nama_produk'];
                                    $detail_ukuran_produk = $fetchDetailOrder['ukuran_produk'];
                                    $detail_quantity_produk = $fetchDetailOrder['quantity_produk'];
                                    $detail_harga_produk = number_format($fetchDetailOrder['harga_produk'], 0,',','.');
                                    $detail_subtotal_produk = $fetchDetailOrder['subtotal_produk'];

                                    $getDataProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$detail_id_produk'");
                                    if(mysqli_num_rows($getDataProduk) > 0){
                                        while($fetchProduk = mysqli_fetch_array($getDataProduk)){
                                            $harga_produk = number_format($fetchProduk['harga_produk'], 0,',','.');
                                            $stok_produk = $fetchProduk['stok_produk'];
                                            $deskripsi_produk = $fetchProduk['deskripsi_produk'];
                                            $gambar_produk = $fetchProduk['gambar_produk'];
                        ?>
                        <tr>
                            <td class="w-25 col-3">
                                <img src="../../img/produk/<?php echo $gambar_produk ?>" class="img-fluid"
                                    style="height:120px;">
                            </td>
                            <td class="w-50">
                                <h5 class="h5"><?php echo $detail_nama_produk; ?></h5>
                                <p class="text-muted truncate-teks">
                                    <?php echo $deskripsi_produk; ?>
                                </p>
                            </td>
                            <td class="text-center" style="width:1rem; ">
                                Rp.<?php echo $detail_harga_produk; ?>
                            </td>
                            <td class="text-center" style="width:1rem; ">
                                Size : <?php echo $detail_ukuran_produk; ?>
                                <?php echo $detail_quantity_produk; ?> pcs
                            </td>
                            <td class="text-center">
                                <text class="fw-bold">
                                    Rp.<?php echo number_format($detail_subtotal_produk , 0,',','.'); ?>

                                </text>
                            </td>
                            <td class="">
                                <a href="remove_item_cart.php?id_order=<?php echo $detail_id_order; ?>&&id_produk=<?php echo $detail_id_produk; ?>&&ukuran_produk=<?php echo $detail_ukuran_produk; ?>"
                                    class="btn btn-danger py-4">
                                    <i class="fas fa-trash"></i>
                                    Remove
                                </a>
                            </td>
                        </tr>
                        <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <!-- BAGIAN ONGKIR DAN PENGIRIMAN -->
                <?php include "cek_ongkir.php"; ?>
                <!-- END OF BAGIAN ONGKIR DAN PENGIRIMAN -->



                <!-- Bagian Payment & Confirmation -->
                <div class="row border border-2 rounded-3 mb-5">
                    <form action="proses_transaksi.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 py-2 text-center">
                                <h4 class="h4 text-primary border-bottom border-primary py-2">Payment & Confirmation</h4>
                            </div>
                        </div>
                        <?php 
                                $getTotalOrder = mysqli_query($connection, "SELECT SUM(harga_produk*quantity_produk) AS TotalBayar FROM tb_order WHERE id_order='$id_order'");
                                if(mysqli_num_rows($getTotalOrder)){
                                    while($fetchTotalOrder = mysqli_fetch_array($getTotalOrder)){
                                        $sub_total = $fetchTotalOrder['TotalBayar'];
                            ?>

                        <div class="row mb-3 align-middle">
                            <div class="col-5 h5">Sub Total : </div>
                            <div class="col-7 h5">
                                <input type="hidden" name="hiddenSubTotal" id="hiddenSubTotal" value="<?php echo $sub_total; ?>">
                                <text class="fw-bold">Rp.<?php echo number_format($sub_total, 0,',','.'); ?></text>
                            </div>
                        </div>
                        <?php
                                    }
                                }
                            ?>
                        
                        <?php 
                                $getDataBankPelanggan = mysqli_query($connection, "SELECT nama_bank, nomor_rekening, nama_lengkap FROM tb_pelanggan WHERE id_pelanggan = '$SESSION_id_pelanggan'");
                                if(mysqli_num_rows($getDataBankPelanggan) >= 0){
                                    while($fetchBankPelanggan = mysqli_fetch_array($getDataBankPelanggan)){
                                        $nama_bank_pelanggan = $fetchBankPelanggan['nama_bank'];
                                        $nama_lengkap = $fetchBankPelanggan['nama_lengkap'];
                        ?>

                        <div class="row mb-3 justify-content-center">
                            <label for="txtNamaBank" class="col-4 col-form-label">Nama Bank : </label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $fetchBankPelanggan['nama_bank']; ?>" class="form-control"
                                    name="txtNamaBank" id="txtNamaBank" readonly>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="txtNoRekening" class="col-4 col-form-label">No Rekening : </label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $fetchBankPelanggan['nomor_rekening']; ?>"
                                    class="form-control" name="txtNoRekening" id="txtNoRekening" readonly>
                            </div>
                        </div>
                        <?php
                                    }
                                }
                        ?>
                        <!-- BAGIAN TRANSAKSI -->


                        <div class="dropdown-divider"></div>
                        <div class="row mb-3 justify-content-center">
                            <label for="txtKodeTransaksi" class="col-5 col-form-label">Kode Transaksi : </label>
                            <div class="col-7">
                                <input type="hidden" name="hiddenIDOrder" value="<?php echo $id_order; ?>">
                                <input type="hidden" name="hiddenIDPelanggan" value="<?php echo $id_pelanggan; ?>">
                                
                                <input type="hidden" name="hiddenKotaTujuan" id="hiddenKotaTujuan">
                                <input type="hidden" name="hiddenAlamatLengkap" id="hiddenAlamatLengkap">
                                <input type="hidden" name="hiddenKurirPengiriman" id="hiddenKurirPengiriman">
                                <input type="hidden" name="hiddenBeratKiriman" id="hiddenBeratKiriman">
                                <input type="hidden" name="hiddenLayananPengiriman" id="hiddenLayananPengiriman">
                                <input type="hidden" name="hiddenTarifPengiriman" id="hiddenTarifPengiriman">
                                <input type="hidden" name="hiddenEstimasiPengiriman" id="hiddenEstimasiPengiriman">

                                <input type="text" value="<?php echo $id_transaksi; ?>" class="form-control"
                                    name="txtKodeTransaksi" id="txtKodeTransaksi" readonly>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="txtStatusTransaksi" class="col-5 col-form-label">Status Transaksi : </label>
                            <div class="col-7">
                                <input type="text" value="Belum Dibayar" class="form-control" name="txtStatusTransaksi"
                                    id="txtStatusTransaksi" readonly>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <!-- END OF BAGIAN TRANSAKSI -->
                        <div class="row">
                            <div class="col-12 py-2 text-center">
                                <h4 class="h4 text-primary">Rekening Toko :</h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php 
                                $getRekeningPerusahaan = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
                                
                                if(mysqli_num_rows($getRekeningPerusahaan) > 0){
                                    while($fetchRekeningPerusahaan = mysqli_fetch_array($getRekeningPerusahaan)){
                                        $nama_pemilik_usaha = $fetchRekeningPerusahaan['nama_pemilik'];
                                        $nama_bank_usaha = $fetchRekeningPerusahaan['nama_bank_usaha'];
                                        $nomor_rekening_usaha = $fetchRekeningPerusahaan['nomor_rekening_usaha'];
                                    
                            ?>
                            <div class="col-6 text-center my-3">
                                <p class="fw-bold h5">
                                    <?php echo $nama_bank_usaha; ?>
                                </p>
                                
                                
                                <p class="fw-bold link-primary fs-5">
                                    <?php echo $nomor_rekening_usaha; ?>
                                </p>
                                <p class="fst-italic text-muted">
                                    a/n <?php echo $nama_pemilik_usaha; ?>
                                </p>
                            </div>
                            <?php 
                                    }
                                }
                            ?>
                        </div>
                        
                        <div class="row mb-4 mx-1">
                            <div class="col-5">
                                <text class="fw-bold h4">Total Bayar : </text>
                            </div>
                            <div class="col-7">
                                <input type="hidden" name="hiddenSubtotal" value="<?php echo $subtotal; ?>">
                                <input type="hidden" name="hiddenTotalBayar" id="hiddenTotalBayar">
                                <text class="fw-bold h4 text-primary" id="resultTotalBayar" name="resultTotalBayar" required oninvalid="this.setCustomValidity('Harap Isi Terlebih Dahulu Jasa Layanan Pengiriman');"></text>
                                
                            </div>
                        </div>
                        

                        <div class="row mb-5">
                            <div class="col-12">
                                <h5 class="h5 text-center border-bottom">
                                    Bukti Pembayaran
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <img src="" id="imgBuktiBayar" name="fotoBuktiBayar" class="img-fluid rounded" style="width:100%; height:150px;">
                                        <input type="file" name="locBuktiBayar" id="locBuktiBayar" accept=".jpg, .jpeg, .png" class="form-control my-1" placeholder="Max Size 5MB" onchange="postImage(this);"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row justify-content-evenly">
                            <div class="col-4 d-grid">
                                <a href="../index.php" class="btn btn-outline-secondary py-2">Home</a>
                            </div>
                            <div class="col-8 d-grid">
                                <input type="submit" value="Proses Pembayaran" class="btn btn-primary py-2" id="btnSubmit" disabled>
                            </div>
                        </div>
                        <div class="row justify-content-center my-4">
                            <div class="col-11 text-center text-dark">
                                Harap Konfirmasi Ke 
                                <a href="https://wa.me/6285360091852?text=Halo%20Kak,%20Saya%20<?php echo $nama_lengkap; ?>%20Akan%20Melakukan%20Transaksi%20:%20*<?php echo $id_transaksi; ?>*%20" target="_blank">
                                WA Admin
                                </a>
                                Setelah Melakukan Pembayaran Agar Barang Segera Dikirim
                                <br>
                                - Terima Kasih -
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Of Bagian Payment & Confirmation -->

                
            </div>
        </div>
    </div>
    <!-- End Of Order Detail On Cart -->

    <!-- Footer -->
    <?php include_once "footer.php"; ?>
    <!-- End Of Footer -->
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function postImage(input){
            var buttonSubmit = document.getElementById("btnSubmit");
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#imgBuktiBayar')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                buttonSubmit.disabled = false;
            } else {
                $('#imgBuktiBayar').attr('src', null);
                buttonSubmit.disabled = true;
            }
        }
        
        // function ini dipanggil didalam file cek_onckir_curl.php pada bagian RadioButton name="rdTarifLayanan" (kalau gak percaya cek aja sendiri, disana ada dua function yang bakalan diproses)
        function funcCekOngkir(){
            var tarifLayanan = document.getElementsByName('rdTarifLayanan');

            var totalBayar = document.getElementById('resultTotalBayar');
            var hiddenSubtotal = document.getElementById('hiddenSubTotal');
            var hiddenTotalBayar = document.getElementById('hiddenTotalBayar');

            for(var i = 0, length = tarifLayanan.length; i < length; i++){
                if(tarifLayanan[i].checked){
                    hasil = Number(hiddenSubtotal.value) + Number(tarifLayanan[i].value)
                    totalBayar.innerHTML =  "Rp." + hasil.toLocaleString();
                    hiddenTotalBayar.value = hasil;                    
                }
            }
        }
        
        // function ini dipanggil didalam file cek_ongkir_curl.php pada bagian RadioButton name="rdTarifLayanan" (kalau gak percaya cek aja sendiri, disana ada dua function yang bakalan diproses)
        function funcGetDataOngkir(){
            var hiddenKotaTujuan = document.getElementById('hiddenKotaTujuan');
            var hiddenAlamatLengkap = document.getElementById('hiddenAlamatLengkap');
            var hiddenKurirPengiriman = document.getElementById('hiddenKurirPengiriman');
            var hiddenBeratKiriman = document.getElementById('hiddenBeratKiriman');
            var hiddenLayananPengiriman = document.getElementById('hiddenLayananPengiriman');
            var hiddenTarifPengiriman = document.getElementById('hiddenTarifPengiriman');
            var hiddenEstimasiPengiriman = document.getElementById('hiddenEstimasiPengiriman');
            var kotaTujuan = document.getElementById('txtKotaTujuan');
            var alamatLengkap = document.getElementById('txtAlamatLengkap');
            var kurirPengiriman = document.getElementById('kurir');
            var beratPengiriman = document.getElementById('berat');

            // Bagian ini pantang dihapus, karena untuk menyimpan data dari file cek_ongkir_curl.php kedalam variabel javascript
            var layananKurir = document.getElementsByName('txtLayananKurir');
            var tarifKurir = document.getElementsByName('rdTarifLayanan');
            var estimasiPengiriman = document.getElementsByName('txtEstimasiPengiriman');
            
            var getTarif;
            var getEstimasi;
            var getLayanan;

            // Bagian ini melooping nilai dari properti pada radiobutton dengan atribut name="rdTarifLayanan" di file cek_ongkir_curl.php
            for(var x = 0; x < tarifKurir.length; x++){
                // cek apakah radiobutton name="rdTarifLayanan" dengan looping bernilai [x] sudah terceklis apa belum
                    if(tarifKurir[x].checked){
                        getTarif = tarifKurir[x].value;
                        // jika looping [x] dari radiobutton name="rdTarifLayanan" sudah terceklis maka lakukan proses pengulaman untuk mencari looping[y] estimasipengiriman yang bernilai loop yang sama dengan tarifLayanan[x]
                        for(var y = x; y < estimasiPengiriman.length; y++){
                            // cek apakah loop[y] estimasiPengiriman sama dengan loop[x] tarifKurir, jika sama maka lanjutkan logic program
                            if(y == x){
                                getEstimasi = estimasiPengiriman[y].value;
                                // lakukan looping lagi untuk layanan kurir dengan loop[z]
                                for(var z = 0; z < layananKurir.length; z++){
                                    // cek kembali apakah loop[z] sama dengan loop[y], jika sama maka lanjutkan logic program untuk mendapatkan value dari layananKurir
                                    if(z == y){
                                        getLayanan = layananKurir[z].value;

                                        hiddenKotaTujuan.value = kotaTujuan.innerHTML;
                                        hiddenAlamatLengkap.value = alamatLengkap.value;
                                        hiddenKurirPengiriman.value = kurirPengiriman.value;
                                        hiddenBeratKiriman.value = beratPengiriman.value;

                                        hiddenLayananPengiriman.value = getLayanan; 
                                        hiddenTarifPengiriman.value = getTarif;
                                        hiddenEstimasiPengiriman.value = getEstimasi+" Hari";

                                        //dibawah ini cuma untuk ngetes nampilin valuenya semua udah pada kesimpan apa belum dari seluruh variabelnya (Ingat! ini kode cuma untuk ngetes dan gak berlaku ke logic program selanjutnya) 
                                        // window.alert(
                                        //     kotaAsal + " | " + 
                                        //     kotaTujuan + " | " + 
                                        //     alamatLengkap + " | " + 
                                        //     kurirPengiriman + " | " + 
                                        //     beratPengiriman + " | " + 
                                        //     getLayanan + " | " + 
                                        //     getTarif + " | " + 
                                        //     getEstimasi +"Hari");
                                    }
                                }
                            }
                            
                            
                        }
                        // Kenapa logicnya jadi ribet begini? karena bagian Cek Ongkir itu menggunakan API dari RajaOngkir yang menggunakan bahasa Javascript Array, AJAX sebagai realtime getting data, dan PHP sebagai penyimpan nilai Valuenya (Ribetlah pokoknya jelasinnya) Wkwkwkwkwk :v
                }
                
            }
            
        }

    </script>
</body>

</html>