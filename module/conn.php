<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_ecommerce";
    // date_default_timezone_set("Asia/Jakarta");
    
    $connection = mysqli_connect($servername, $username, $password, $dbname);
    if(!$connection){
        die("Connection Failed: ".mysqli_connect_error());
        echo json_encode("Connection Failed".mysqli_connect_error());
    }
?>