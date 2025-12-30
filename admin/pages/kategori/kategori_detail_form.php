<?php include "../../../module/conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
    <title>Admin - Kategori</title>
</head>
<body>
    <?php include_once "navigasi_kategori.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <h2 class="h2">Manajemen Kategori</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-5 pb-5">
                <form action="proses_detail_kategori.php" method="post" class="px-5 mx-5">
                    <div class="card text-center bg-body mx-5">
                        <div class="card-header h5 bg-body">
                            Detail Kategori
                        </div>
                        <div class="card-body">
                        <?php 
                            $id_kategori = $_GET['id_kategori'];
                            $resultKategori = mysqli_query($connection, "SELECT * FROM tb_kategori WHERE id_kategori = '$id_kategori'");
                            while($fetchDetailKategori = mysqli_fetch_array($resultKategori)){
                                $nama_kategori = $fetchDetailKategori['nama_kategori'];
                        ?>
                            <div class="row mb-2 px-5">
                                <label for="txtIDKategori" class="col-3 col-form-label text-start">ID Kategori :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $id_kategori; ?>" readonly name="txtIDKategori" id="txtIDKategori">
                                </div>
                            </div>
                            <div class="row mb-2 px-5">
                                <label for="txtNamaKategori" class="col-3 col-form-label text-start">Nama Kategori :</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" value="<?php echo $nama_kategori; ?>" name="txtNamaKategori" id="txtNamaKategori">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-body text-muted">
                            <div class="row">
                                <!-- <div class="col-2"></div> -->
                                <div class="col-3">
                                    <a href="kategori_pages.php" class="btn btn-outline-secondary px-5">Cancel</a>
                                </div>
                                <div class="col-9 d-inline gap-2">
                                    <input type="submit" name="submitDelete" value="Hapus" class="btn btn-outline-danger px-5">
                                    <input type="submit" name="submitSave" value="Simpan" class="btn btn-outline-primary px-5">
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once "footer_kategori.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>