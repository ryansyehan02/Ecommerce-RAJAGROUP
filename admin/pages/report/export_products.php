<?php
    include_once('../../../module/conn.php');

    $filterKategori = $_POST['slFilterKategori'];
    
    $nama_file = 'All Products Of '.$filterKategori." ".date("d F Y");

    // Ini Jangan Dihapus Karena Untuk Export Ke Excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$nama_file.xls");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama_file; ?></title>
    <style type="text/css">
        table{
            margin: 20px auto;
            border-collapse: collapse;
            font-family: sans-serif;
        }
        table th,
        table td{
            border: 1px solid #3c3c3c;
            text-align: center;
            vertical-align:middle;
        }
    </style>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            
            <tbody>
                <tr>
                    <th style="height:50px; background-color:#334257; color:#FFF;">#</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">ID Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Nama Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Harga Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Kategori Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Stok Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Ukuran Produk</th>
                    <th style="height:50px; background-color:#334257; color:#FFF;">Deskripsi Produk</th>
                </tr>
                <?php 
                    if(isset($_POST['submitExportAllProducts'])){
                        if($filterKategori == 'all_category'){
                            $queryAllProducts = mysqli_query($connection, "SELECT * FROM tb_produk ORDER BY nama_produk ASC");
                        } else {
                            $queryAllProducts = mysqli_query($connection, "SELECT * FROM tb_produk WHERE kategori_produk = '$filterKategori' ORDER BY nama_produk ASC");
                        }
                        $no = 0;
                        while($fetchAllProducts = mysqli_fetch_array($queryAllProducts)){
                            $no++;
                            $id_produk = $fetchAllProducts['id_produk'];
                            $nama_produk = $fetchAllProducts['nama_produk'];
                            $harga_produk = $fetchAllProducts['harga_produk'];
                            $kategori_produk = $fetchAllProducts['kategori_produk'];
                            $stok_produk = $fetchAllProducts['stok_produk'];
                            $ukuran_produk = $fetchAllProducts['ukuran_produk'];
                            $deskripsi_produk = $fetchAllProducts['deskripsi_produk'];
                            if($stok_produk <= 5 AND $stok_produk >= 2){
                                $warningColor = 'yellow';
                            } else if($stok_produk <= 1){
                                $warningColor = 'red';
                            } else {
                                $warningColor = 'white';
                            }
                ?>
                    <tr class="">
                        <td style="width:30px;">
                            <?php echo $no;?>
                        </td>
                        <td style="width:100px;">
                            <?php echo $id_produk;?>
                        </td>
                        <td style="width:200px;">
                            <?php echo $nama_produk;?>
                        </td>
                        <td style="width:140px;">
                            Rp.<?php echo $harga_produk;?>
                        </td>
                        <td style="width:200px;">
                            <?php echo $kategori_produk;?>
                        </td>
                        <td style="width:120px; background-color:<?php echo $warningColor; ?>">
                            <?php echo $stok_produk;?>pcs
                        </td>
                        <td style="width:140px;">
                            <?php echo $ukuran_produk;?>
                        </td>
                        <td style="width:400px;">
                            <?php echo $deskripsi_produk;?>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>