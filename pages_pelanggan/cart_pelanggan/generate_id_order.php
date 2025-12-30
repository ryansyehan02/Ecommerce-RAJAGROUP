<?php
    // Get Data Pelanggan Sesuaikan ID Pelanggan Dengan SESSION ID Pelanggan
    $getDataPelanggan = mysqli_query($connection, "SELECT id_pelanggan FROM tb_pelanggan WHERE id_pelanggan = '$SESSION_id_pelanggan'");
    $fetchDataPelanggan = mysqli_fetch_array($getDataPelanggan);
    $getIDPelanggan = $fetchDataPelanggan['id_pelanggan'];

    // Hitung Seluruh Record Pada Tabel Transaksi Sesuai Dengan SESSION ID Pelanggan dan Status Belum Dibayar
    $getDataTransaksiOrder = mysqli_query($connection, "SELECT COUNT(id_order) AS countOrder FROM tb_transaksi WHERE id_pelanggan = '$getIDPelanggan'");
    $fetchDataTransaksiOrder = mysqli_fetch_array($getDataTransaksiOrder);

    // Generate ID Order
    $id_order = "OR".$getIDPelanggan."".$fetchDataTransaksiOrder['countOrder'];

?>