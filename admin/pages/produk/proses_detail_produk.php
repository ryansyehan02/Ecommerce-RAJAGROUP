<?php 
    include "../../../module/conn.php"; 
    error_reporting (E_ALL ^ E_NOTICE);
    $submitSave = $_POST['submitSave'];
    $submitDelete = $_POST['submitDelete'];

    $id_produk = $_POST['txtIDProduk'];
    $nama_produk = $_POST['txtNamaProduk'];
    $harga_produk = $_POST['txtHargaProduk'];
    $kategori_produk = $_POST['slKategori'];
    $stok_produk = $_POST['txtStok'];
    $ukuran_produk = $_POST['txtUkuran'];
    $deskripsi_produk = $_POST['txtDeskripsi'];
    $gambar_produk = $_POST['fotoProduk'];

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


    if($submitSave){
        $updateProduk = mysqli_query($connection, "UPDATE tb_produk SET nama_produk='$nama_produk', harga_produk='$harga_produk', kategori_produk='$kategori_produk', stok_produk='$stok_produk', ukuran_produk='$ukuran_produk', deskripsi_produk='$deskripsi_produk' WHERE id_produk = '$id_produk'");
        if($updateProduk){
            echo "<script type='text/javascript'>
                alert('Update Produk: $nama_produk Sukses');
                window.location='produk_pages.php';
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Update Produk: $nama_produk Gagal');
                window.location='produk_pages.php';
            </script>";
        }
    } else if($submitDelete){
        unlink("../../../img/produk/".$id_produk);
        $deleteProduk = mysqli_query($connection, "DELETE FROM tb_produk WHERE id_produk = '$id_produk'");
        if($deleteProduk){
            echo "<script type='text/javascript'>
                alert('Delete Produk: $nama_produk Sukses');
                window.location='produk_pages.php';
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Delete Produk: $nama_produk Gagal');
                window.location='produk_pages.php';
            </script>";
        }
    }
?>