<?php 
    include "../../../module/conn.php";
    $id_kategori = $_POST['txtIDKategori'];
    $nama_kategori = $_POST['txtNamaKategori'];

    $resultKategori = mysqli_query($connection, "INSERT INTO tb_kategori VALUES('$id_kategori', '$nama_kategori')");
    if($resultKategori){
        echo "<script type='text/javascript'>
                    alert('Input Data Success!');
                    window.location='kategori_pages.php';
                </script>";
    }else{
        "<script type='text/javascript'>
                    alert('Input Data Failed!');
                    window.location='kategori_pages.php';
                </script>";
    }
?>