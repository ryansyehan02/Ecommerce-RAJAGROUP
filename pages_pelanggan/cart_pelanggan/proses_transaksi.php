<?php
    include "../../module/conn.php";
    
    session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
    $SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];

    // Variabel yang dibutuhkan pada tb_transaksi
    $id_transaksi = $_POST['txtKodeTransaksi'];
    $id_order = $_POST['hiddenIDOrder'];
    $id_pelanggan = $_POST['hiddenIDPelanggan'];
    $tanggal_transaksi = date("Y-m-d");
    $waktu_transaksi = date("h:i:s");
    $total_transaksi = $_POST['hiddenTotalBayar'];
    $status_transaksi = $_POST['txtStatusTransaksi'];
    $nomor_rekening_pelanggan = $_POST['txtNoRekening'];
    // $bukti_pembayaran = $_POST['locBuktiBayar'];
    $kota_tujuan = $_POST['hiddenKotaTujuan'];
    $alamat_lengkap = $_POST['hiddenAlamatLengkap'];
    $kurir_pengiriman = $_POST['hiddenKurirPengiriman'];
    $berat_kiriman = $_POST['hiddenBeratKiriman'];
    $layanan_pengiriman = $_POST['hiddenLayananPengiriman'];
    $tarif_pengiriman = $_POST['hiddenTarifPengiriman'];
    $estimasi_pengiriman = $_POST['hiddenEstimasiPengiriman'];

    // echo $id_transaksi." | ";
    // echo $id_order." | ";
    // echo $id_pelanggan." | ";
    // echo $tanggal_transaksi." | ";
    // echo $waktu_transaksi." | ";
    // echo $total_transaksi." | ";
    // echo $nomor_rekening_pelanggan." | ";
    // // echo $bukti_pembayaran." | ";

    // echo $kota_tujuan." | ";
    // echo $alamat_lengkap." | ";
    // echo $kurir_pengiriman." | ";
    // echo $berat_kiriman." | ";
    // echo $layanan_pengiriman." | ";
    // echo $tarif_pengiriman." | ";
    // echo $estimasi_pengiriman." | ";

    
    $photo_name = $id_transaksi;
    $photo_size = $_FILES['locBuktiBayar']['size'];
    $photo_type = $_FILES['locBuktiBayar']['type'];
    $photo_temp = $_FILES['locBuktiBayar']['tmp_name'];
    $path_move = "../../img/bukti_transaksi/".$photo_name;
    $move_files = move_uploaded_file($photo_temp, $path_move);
    if($photo_type == "image/jpeg" || $photo_type == "image/png"){
        // Photo size 10.485.760 Bytes = 10 Megabytes
        if($photo_size <= 10485760){
            if($move_files){
                echo "<script> alert('Foto Berhasil Dipindahkan Ke Direktori Utama Foto Bukti Transaksi'); </script>";
            } else {
                echo "<script> alert('Foto Gagal Dipindahkan!'); </script>";
            }
        } else {
            echo "<script> alert('Ukuran File Maksimum 10MB'); </script>";
        }
    }

    $insertTransaksi = mysqli_query($connection, 
        "INSERT INTO tb_transaksi VALUES(
        '$id_transaksi', 
        '$id_order', 
        '$id_pelanggan', 
        '$tanggal_transaksi', 
        '$waktu_transaksi', 
        '$total_transaksi', 
        '$status_transaksi', 
        '$nomor_rekening_pelanggan', 
        '$photo_name', 
        '$kota_tujuan', 
        '$alamat_lengkap', 
        '$kurir_pengiriman', 
        '$berat_kiriman', 
        '$layanan_pengiriman', 
        '$tarif_pengiriman', 
        '$estimasi_pengiriman',
        ''
        )
    ");
    if($insertTransaksi){
        // Bagian ini adalah untuk mengupdate data stok produk pada tb_produk
        // Data Produk diambil dari tb_order sesuai dengan id_order yang sedang berjalan
        $getDataOrder = mysqli_query($connection, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
        while($fetchDataOrder = mysqli_fetch_array($getDataOrder)){
            $id_produk = $fetchDataOrder['id_produk'];
            $nama_produk = $fetchDataOrder['nama_produk'];
            $qty_produk = $fetchDataOrder['quantity_produk'];
            if($fetchDataOrder){
                // Lalu Data Produk pada tb_produk dipilih sesuai dengan id_produk yang ada pada tb_order
                $getDataProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");
                while($fetchDataProduk = mysqli_fetch_array($getDataProduk)){
                    // simpan stok produk pada tb_produk
                    $stok_produk = $fetchDataProduk['stok_produk'];
                    // lalu kalkulasi antara stok produk pada tb_produk dengan quantity produk pada tb_order
                    $upd_stok_produk = $stok_produk - $qty_produk;
                    echo $upd_stok_produk."<br/>";
                    if($fetchDataProduk){
                        // lalu Update stok produk terbaru yang telah dikalkulasi pada tb_produk
                        $upd_data_produk = mysqli_query($connection, "UPDATE tb_produk SET stok_produk = '$upd_stok_produk' WHERE id_produk = '$id_produk'");
                        if($upd_data_produk){
                            echo "<script type='text/javascript'>
                                alert('Transaksi Sukses!');
                                window.location='../transaksi_pelanggan/detail_transaksi.php';
                            </script>";
                        } else {
                            echo "<script type='text/javascript'>
                                        alert('UPDATE TB PRODUK GAGAL!');
                                        window.location='detail_cart.php?id_order=$id_order';
                                    </script>";
                        }
                    }
                }
            }
        }
    } else {
        echo "<script type='text/javascript'>
                    alert('Transaksi Gagal!');
                    window.location='detail_cart.php?id_order=$id_order';
                </script>";
    }
?>