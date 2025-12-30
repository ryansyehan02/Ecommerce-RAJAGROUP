<?php
    include_once('../../../module/conn.php');

    $filterCustomers = $_POST['slFilterCustomers'];
    $filterSort = $_POST['slFilterSortCustomer'];

    $nama_file = 'All Customers Sort By '.$filterCustomers." ".date("d F Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama_file; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/custom_css.css">
</head>
<body onload="PrintToPDF();">
    <div class="container-fluid px-5 bg-light">
            <?php
                $queryDataPerusahaan = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
                $fetchDataPerusahaan = mysqli_fetch_array($queryDataPerusahaan);
                $nama_usaha = $fetchDataPerusahaan['nama_usaha'];
                $alamat_usaha = $fetchDataPerusahaan['alamat_usaha'];
                $no_telepon_usaha = $fetchDataPerusahaan['no_telepon_usaha'];
                $email_usaha = $fetchDataPerusahaan['email_usaha'];
                $instagram_usaha = $fetchDataPerusahaan['instagram_usaha'];
            ?>
        <div class="row py-4 align-items-center">
            <div class="col-3 text-start">
                <h5 class="h5 fw-bold "><?php echo $nama_usaha; ?></h5>
                <span class="text-muted fs-6"><?php echo $alamat_usaha; ?></span>
                <span class="text-muted fs-6"><?php echo $email_usaha; ?></span> <br>
                <span class="text-muted fs-6">Telp: <?php echo $no_telepon_usaha; ?></span>
            </div>
            <div class="col-9 text-end">
                <h5 class="h5 text-muted">Laporan Data Customers</h5>
                <span class="text-muted">Laporan Bulan : <?php echo date("F Y"); ?></span>
            </div>
        </div>
        <div class="row align-items-center text-muted fw-lighter fst-italic">
            <div class="col-6 text-start">
                <text class="text-muted">
                    Description : List Of All Customers
                </text>
            </div>
            <div class="col-6 text-end">
                Printed On : <?php echo date("d F Y"); ?>
            </div>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center align-middle">#</th>
                <th scope="col" class="text-center align-middle">ID Pelanggan</th>
                <th scope="col" class="text-center align-middle">Nama Lengkap</th>
                <th scope="col" class="text-center align-middle">Tanggal Lahir</th>
                <th scope="col" class="text-center align-middle">Alamat Lengkap</th>
                <th scope="col" class="text-center align-middle">No Telepon</th>
                <th scope="col" class="text-center align-middle">Email</th>
                <th scope="col" class="text-center align-middle">No Rekening</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['submitExportAllCustomers'])){
                    $queryAllCustomers = mysqli_query($connection, "SELECT * FROM tb_pelanggan ORDER BY '$filterCustomers' '$filterSort'");
                        $no = 0;
                        while($fetchAllCustomers = mysqli_fetch_array($queryAllCustomers)){
                            $no++;
                            $id_pelanggan = $fetchAllCustomers['id_pelanggan'];
                            $email = $fetchAllCustomers['email'];
                            $password_akses = $fetchAllCustomers['password_akses'];
                            $nama_lengkap = $fetchAllCustomers['nama_lengkap'];
                            $tanggal_lahir = $fetchAllCustomers['tanggal_lahir'];
                            $alamat_lengkap = $fetchAllCustomers['alamat_lengkap'];
                            $nomor_telepon = $fetchAllCustomers['nomor_telepon'];
                            $nomor_rekening = $fetchAllCustomers['nomor_rekening'];
                            $nama_bank = $fetchAllCustomers['nama_bank'];
                            
                            
            ?>
            <tr class="align-middle">
                <td class="text-center text-wrap" style="width:1rem;">
                    <?php echo $no; ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $id_pelanggan; ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $nama_lengkap; ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $tanggal_lahir; ?>
                </td>

                <td class="text-center text-wrap w-25">
                    <?php echo $alamat_lengkap; ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $nomor_telepon; ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $email ?>
                </td>

                <td class="text-center text-wrap">
                    <?php echo $nama_bank." - ".$nomor_rekening; ?>
                </td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    </div>
    



    <script src="https://kit.fontawesome.com/6dec954a85.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function PrintToPDF(){
            var css = '@page {size: landscape, margin:none, scale:80}',
                head = document.head || document.GetElementsByName('head')[0],
                style = document.createElement('style');
            style.type = 'text/css';
            style.media = 'print';
            if(style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            window.print();
            window.onafterprint = function(event){
                window.location.href = 'report_pages.php';
            }
        }
    </script>
</body>
</html>