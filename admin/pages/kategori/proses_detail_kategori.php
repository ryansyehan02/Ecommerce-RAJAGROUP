<?php 
    include "../../../module/conn.php"; 
    error_reporting (E_ALL ^ E_NOTICE);
    $submitSave = $_POST['submitSave'];
    $submitDelete = $_POST['submitDelete'];

    $id_kategori = $_POST['txtIDKategori'];
    $nama_kategori = $_POST['txtNamaKategori'];

    if($submitSave){
        $updateKategori = mysqli_query($connection, "UPDATE tb_kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'");
        if($updateKategori){
            echo "<script type='text/javascript'>
                alert('Update Kategori: $nama_kategori Sukses');
                window.location='kategori_pages.php';
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Update Kategori: $nama_kategori Gagal!');
                window.location='kategori_pages.php';
            </script>"; 
        }
    } else if($submitDelete){
        $deleteKategori = mysqli_query($connection, "DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'");
        if($deleteKategori){
            $updateProduk2 = mysqli_query($connection, "UPDATE tb_produk SET kategori_produk = 'No Category' WHERE kategori_produk = '$nama_kategori'");
            echo "<script type='text/javascript'>
                    alert('Kategori Telah Dihapus Dan Seluruh Data Produk Dengan Kategori: $nama_kategori Telah Diubah!');
                    window.location='kategori_pages.php';
                </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Kategori Gagal Dihapus!');
                    window.location='kategori_pages.php';
                </script>";
        }
    }
?>