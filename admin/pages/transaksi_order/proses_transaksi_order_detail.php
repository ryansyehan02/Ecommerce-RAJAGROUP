<?php 
    include_once "../../../module/conn.php";
    $id_transaksi = $_POST['txtKodeTransaksi'];
    $status_transaksi = $_POST['slStatus'];
    $nomor_resi_kurir = $_POST['txtNomorResiKurir'];

    $updateStatusTransaksi = mysqli_query($connection, "UPDATE tb_transaksi SET status_transaksi = '$status_transaksi', nomor_resi_kurir='$nomor_resi_kurir' WHERE id_transaksi = '$id_transaksi'");
    // echo $id_transaksi." - ".$status_transaksi;
    // print($updateStatusTransaksi);
    if($updateStatusTransaksi){
        echo "<script type='text/javascript'>
            alert('Update Status: $status_transaksi');
            window.location='transaksi_pages.php';
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Update Status: $status_transaksi Gagal!');
            window.location='transaksi_pages.php';
        </script>"; 
    }
?>