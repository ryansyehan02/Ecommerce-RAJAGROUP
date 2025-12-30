<?php
    include "../../../module/conn.php";
    $id_produk = $_POST['txtIDProduk'];
    $nama_produk = $_POST['txtNamaProduk'];
    $harga_produk = $_POST['txtHargaProduk'];
    $kategori = $_POST['slKategori'];
    $stok_produk = $_POST['txtStok'];
    $ukuran_produk = $_POST['txtUkuran'];
    $deskripsi = $_POST['txtDeskripsi'];

    $photo_name = $id_produk;
    $photo_size = $_FILES['locFotoProduk']['size'];
    $photo_type = $_FILES['locFotoProduk']['type'];
    $photo_temp = $_FILES['locFotoProduk']['tmp_name'];
    $path_move = "../../../img/produk/".$photo_name.".png";
    $move_files = move_uploaded_file($photo_temp, $path_move);
    if($photo_type == "image/jpeg" || $photo_type == "image/png"){
        // Photo_Size 5.242.880 Bytes = 5 Megabytes
        if($photo_size <= 5242880){
            if($move_files){
                echo "<script> alert('Foto Berhasil Dipindahkan Ke Direktori Utama Foto Produk'); </script>";
            } else {
                echo "<script> alert('Foto Gagal Dipindahkan!'); </script>";
            }
        } else {
            echo "<script> alert('Ukuran File Maksimum 5MB'); </script>";
        }
    }
    $resultProduk = mysqli_query($connection, "INSERT INTO tb_produk VALUES('$id_produk','$nama_produk','$harga_produk','$kategori','$stok_produk','$ukuran_produk','$deskripsi','$photo_name')");
    if($resultProduk){
        echo "<script type='text/javascript'>
                    alert('Input Data Success!');
                    window.location='produk_pages.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                    alert('Input Data Failed!');
                    window.location='produk_pages.php';
                    </script>";
    }
?>