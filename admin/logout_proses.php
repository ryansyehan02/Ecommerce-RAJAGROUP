<?php 
    session_destroy();
    header("location:index.php?pesan=Logout Sistem");
    exit;
?>