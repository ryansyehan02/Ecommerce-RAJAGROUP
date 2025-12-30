<?php
    session_start();
    $_SESSION['nama_lengkap'] = '';
    unset($_SESSION['nama_lengkap']);
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
?>