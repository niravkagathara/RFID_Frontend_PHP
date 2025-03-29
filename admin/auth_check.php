<?php 
session_start();
if(isset($_COOKIE["email"])){
    $_SESSION["email"] = $_COOKIE["email"];
}
if (!isset($_SESSION["email"])) {
    header("Location: ../login.php");
    exit();
}
?>