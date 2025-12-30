<?php 
    include "module/conn.php";

    $id_pelanggan = $_POST['txtIDPelanggan'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $nama_lengkap = $_POST['txtNamaLengkap'];
    $tanggal_lahir = $_POST['dtTanggalLahir'];
    $alamat_lengkap = $_POST['txtAlamatLengkap'];
    $nama_bank = $_POST['slNamaBank'];
    $no_rekening = $_POST['txtNoRekening'];
    $nomor_telepon = $_POST['txtNoTelepon'];

    $resultRegister = mysqli_query($connection, "INSERT INTO tb_pelanggan VALUES('$id_pelanggan', '$email', '$password', '$nama_lengkap', '$tanggal_lahir', '$alamat_lengkap', '$nomor_telepon', '$no_rekening', '$nama_bank')");
    if($resultRegister){
        echo "<script type='text/javascript'>
                    alert('Register Account Success! Signing In Processed');
                    window.location='pages_pelanggan/index.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                    alert('Register Account Failed!');
                    window.location='index.php';
                </script>";
    }
?>