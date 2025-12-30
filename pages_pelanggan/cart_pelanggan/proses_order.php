<?php 
    include "../../module/conn.php";
    session_start();
    if (!isset($_SESSION['id_pelanggan'])){
        header("Location: ../index.php");
    }
	$SESSION_id_pelanggan = $_SESSION['id_pelanggan'];
    $SESSION_nama_pelanggan = $_SESSION['nama_pelanggan'];

    $id_produk = $_GET['id_produk'];
    $ukuran_produk = $_POST['txtUkuran'];
    $quantity = $_POST['txtQuantity'];

    include "generate_id_order.php";

    // Ambil Data Produk di Database Dengan ID Produk
    $getProduk = mysqli_query($connection, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");
    if(mysqli_num_rows($getProduk) > 0 ){
        $fetchProduk = mysqli_fetch_array($getProduk);
        $nama_produk = $fetchProduk['nama_produk'];
        $harga_produk = $fetchProduk['harga_produk'];

        // Generate ID Order
        include_once "generate_id_order.php";
        
        $subtotal_produk = $harga_produk * $quantity;


        // Cek Jika Produk Yang Dipilih Sudah Ada Dengan ID Order, ID Produk, dan Ukuran Produk Yang Sama (Jika customer ingin menambah quantity dari produk yang sama)
        $getQtyProduk = mysqli_query($connection, "SELECT quantity_produk, harga_produk FROM tb_order WHERE id_order = '$id_order' AND id_produk='$id_produk' AND ukuran_produk = '$ukuran_produk'");
        if(mysqli_num_rows($getQtyProduk) > 0){
            $fetchQtyProduk = mysqli_fetch_array($getQtyProduk);
            $get_qty = $fetchQtyProduk['quantity_produk'];
            $get_harga_produk = $fetchQtyProduk['harga_produk'];

            // Totalkan Quantity dan Total Harga Dari ID Order Yang Sama
            $upd_qty = $quantity + $get_qty;
            $upd_subtotal_produk = $harga_produk * $upd_qty;

            // Updata Data Order Pada Tabel Order
            $updateQtyProdukOrder = mysqli_query($connection, "UPDATE tb_order SET quantity_produk='$upd_qty', subtotal_produk='$upd_subtotal_produk' WHERE id_order='$id_order' AND id_produk='$id_produk' AND ukuran_produk = '$ukuran_produk'");
            if($updateQtyProdukOrder){
                echo "<script type='text/javascript'>
                    alert('Quantity Order Added!');
                    window.location='../cart_pelanggan/detail_cart.php?id_order=$id_order';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Quantity Added Failed!');
                    window.location='produk_detail.php';
                </script>";
            }
        } else {


            // Tambah Data Orderan Kedalam Tabel Order
            $insertOrder = mysqli_query($connection, "INSERT INTO tb_order SET id_order='$id_order', id_produk='$id_produk', id_pelanggan='$SESSION_id_pelanggan', nama_produk='$nama_produk', ukuran_produk='$ukuran_produk', quantity_produk='$quantity', harga_produk='$harga_produk', subtotal_produk='$subtotal_produk'");
            if($insertOrder){
                echo "<script type='text/javascript'>
                    alert('Order Added!');
                    window.location='../cart_pelanggan/detail_cart.php?id_order=$id_order';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Order Failed! ntah kenapa');
                    window.location='produk_detail.php';
                </script>";
            }
        }
        
        
    }
?>