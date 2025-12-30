<?php include "../../../module/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
    <title>Admin - Pelanggan</title>
</head>
<body>
    <?php include_once "navigasi_pelanggan.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <h2 class="h2">Manajemen Pelanggan</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pb-5 pt-2">
                    <div class="card text-center bg-body mx-5">
                        <div class="card-header h5 bg-body">
                            Detail Pelanggan
                        </div>
                        <div class="card-body">
                        <?php 
                            $id_pelanggan = $_GET['id_pelanggan'];
                            $resultPelanggan = mysqli_query($connection, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
                            while($fetchDetailPelanggan = mysqli_fetch_array($resultPelanggan)){
                                $id_pelanggan = $fetchDetailPelanggan['id_pelanggan'];
                                $nama_pelanggan = $fetchDetailPelanggan['nama_lengkap'];
                                $email_pelanggan = $fetchDetailPelanggan['email'];
                                $password = $fetchDetailPelanggan['password_akses'];
                                $tanggal_lahir = $fetchDetailPelanggan['tanggal_lahir'];
                                $alamat_pelanggan = $fetchDetailPelanggan['alamat_lengkap'];
                                $no_rekening = $fetchDetailPelanggan['nomor_rekening'];
                                $nama_bank = $fetchDetailPelanggan['nama_bank'];     
                        ?>
                            <div class="row mb-2 px-5">
                                <label for="txtIDPelanggan" class="col-3 col-form-label text-start">ID Pelanggan :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $id_pelanggan; ?>" readonly name="txtIDPelanggan" id="txtIDPelanggan">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtNamaPelanggan" class="col-3 col-form-label text-start">Nama Pelanggan :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $nama_pelanggan; ?>" readonly name="txtNamaPelanggan" id="txtNamaPelanggan">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtTanggalLahir" class="col-3 col-form-label text-start">Tanggal Lahir :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $tanggal_lahir; ?>" readonly name="txtTanggalLahir" id="txtTanggalLahir">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtEmailPelanggan" class="col-3 col-form-label text-start">Email :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $email_pelanggan; ?>" readonly name="txtEmailPelanggan" id="txtEmailPelanggan">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtPasswordPelanggan" class="col-3 col-form-label text-start">Password :</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" value="<?php echo $password; ?>" readonly name="txtPasswordPelanggan" id="txtPasswordPelanggan">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtNoRekening" class="col-3 col-form-label text-start">No Rekening :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $nama_bank.' - '.$no_rekening; ?>" readonly name="txtNoRekening" id="txtNoRekening">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtAlamatLengkap" class="col-3 col-form-label text-start">Alamat Lengkap :</label>
                                <div class="col-9">
                                    <textarea name="txtAlamatLengkap" id="txtAlamatLengkap" cols="5" rows="4" class="form-control" style="resize:none;" readonly><?php echo $alamat_pelanggan; ?></textarea>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-body text-muted">
                            <div class="row justify-content-around">
                                <!-- <div class="col-2"></div> -->
                                <div class="col-3">
                                    <a href="pelanggan_pages.php" class="btn btn-outline-secondary px-5">Cancel</a>
                                </div>
                                <div class="col-3">
                                    <a href="pelanggan_pages.php" class="btn btn-outline-primary px-5">Simpan</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <?php include_once "footer_pelanggan.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>