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
            <div class="col-12 px-5 py-2 border overflow-auto" style="height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-start">ID Pelanggan</th>
                            <th scope="col" class="text-start">Nama Pelanggan</th>
                            <th scope="col" class="text-start">Email</th>
                            <th scope="col" class="text-start">Alamat Lengkap</th>
                            <th scope="col" class="text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        error_reporting (E_ALL ^ E_NOTICE);
                        $resultPelanggan = mysqli_query($connection, "SELECT * FROM tb_pelanggan");
                        if(mysqli_num_rows($resultPelanggan) > 0){
                            while($fetchPelanggan = mysqli_fetch_array($resultPelanggan)){
                                $id_pelanggan = $fetchPelanggan['id_pelanggan'];
                                $nama_pelanggan = $fetchPelanggan['nama_lengkap'];
                                $email_pelanggan = $fetchPelanggan['email'];
                                $alamat_pelanggan = $fetchPelanggan['alamat_lengkap'];                         
                    ?>
                        <tr class="align-middle">
                            <td class="w-25 text-start">
                                <?php echo $id_pelanggan; ?>
                            </td>
                            <td class="w-25 text-start">
                                <?php echo $nama_pelanggan; ?>
                            </td>
                            <td class="w-25 text-start">
                                <?php echo $email_pelanggan; ?>
                            </td>
                            <td class="w-25 text-start">
                                <?php echo $alamat_pelanggan; ?>
                            </td>
                            <td class="text-center">
                                <a href="pelanggan_detail_form.php?id_pelanggan=<?php echo $id_pelanggan; ?>" class="btn btn-outline-primary px-4">Detail</a>
                            </td>
                        </tr>
                    <?php 
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include_once "footer_pelanggan.php"; ?>
    
    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>