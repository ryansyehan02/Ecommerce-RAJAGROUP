<?php 
    include "module/conn.php";
    

    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    $resultLogin = mysqli_query($connection, "SELECT * FROM tb_pelanggan WHERE email = '$email' AND password_akses = '$password'");
    $rowsLogin = mysqli_num_rows($resultLogin);
    if($rowsLogin > 0){
        $fetchData = mysqli_fetch_array($resultLogin);
        session_start();
        $_SESSION['id_pelanggan'] = $fetchData['id_pelanggan'];
        $_SESSION['nama_pelanggan'] = $fetchData['nama_lengkap'];
        $_SESSION['email'] = $email;
        $_SESSION['status'] = 'Login';
        header("location:pages_pelanggan/index.php");
    } else {
        header("location:index.php?pesan=Users Not Found");
    }
?>