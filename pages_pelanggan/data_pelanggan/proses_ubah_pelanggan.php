<?php
    include "../../module/conn.php";
    // error_reporting (E_ALL ^ E_NOTICE);
    $submitSave = $_POST['submitSave'];

    $id_pelanggan = $_POST['hiddenIDPelanggan'];
    $nama_lengkap = $_POST['txtNamaLengkap'];
    $tanggal_lahir = $_POST['dtTanggalLahir'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $nama_bank = $_POST['slNamaBank'];
    $no_rekening = $_POST['txtNoRekening'];
    $alamat_lengkap = $_POST['txtAlamat'];
    $nomor_telepon = $_POST['txtNoTelepon'];
    if($submitSave){
        $updatePelanggan = mysqli_query($connection, "UPDATE tb_pelanggan SET 
            id_pelanggan = '$id_pelanggan', 
            email = '$email', 
            password_akses = '$password', 
            nama_lengkap = '$nama_lengkap', 
            tanggal_lahir = '$tanggal_lahir', 
            alamat_lengkap = '$alamat_lengkap', 
            nomor_rekening = '$no_rekening', 
            nama_bank = '$nama_bank',
            nomor_telepon = '$nomor_telepon'
            WHERE id_pelanggan = '$id_pelanggan'");

        if($updatePelanggan){
            echo "<script type='text/javascript'>
                alert('Update Data: $nama_lengkap Sukses');
                window.location='profile_pelanggan.php';
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Update Data: $nama_lengkap Gagal!');
                window.location='profile_pelanggan.php';
            </script>";
        }
    }
?>