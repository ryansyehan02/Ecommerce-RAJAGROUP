<?php 
    include "../module/conn.php";
    session_start();

    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $queryLogin = mysqli_query($connection, "SELECT * FROM tb_admin WHERE username = '$username' AND password_akses='$password'");
    $resultLogin = mysqli_num_rows($queryLogin);

    if($resultLogin > 0){
        $fetchData = mysqli_fetch_assoc($queryLogin);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['statusSession'] = 'Login';
        $_SESSION['id_admin'] = $fetchData['id_admin'];
        header("location:pages/dashboard_admin.php");
    } else {
        header("location:index.php?pesan=Users Not Found");
        
    }
?>