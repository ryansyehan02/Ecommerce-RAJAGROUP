<?php 
    include_once "../../module/conn.php";
    $id_order = $_GET['id_order'];
    $id_produk = $_GET['id_produk'];
    $ukuran_produk = $_GET['ukuran_produk'];

    echo $id_order."<br>";
    echo $id_produk."<br>";

    $deleteItemOrder = mysqli_query($connection, "DELETE FROM tb_order WHERE id_order='$id_order' AND id_produk='$id_produk' AND ukuran_produk = '$ukuran_produk'");
    if($deleteItemOrder){
        echo "<script type='text/javascript'>
            alert('Remove Item!');
            window.location='detail_cart.php?id_order=$id_order';
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Cant Remove Item!');
            window.location='detail_cart.php?id_order=$id_order';
        </script>";
    }
?>