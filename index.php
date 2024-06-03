<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>location.href = 
    './transactionApp/views/login.php';
    </script>";
    exit;
} else{
    echo "<script>location.href = 
    './transactionApp/views/home.php';
    </script>";
    exit;
}