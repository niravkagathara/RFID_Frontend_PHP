<?php
    session_start();
    if(isset($_COOKIE["email"])){
        setcookie("email", "", time() - 3600);
    }
    setcookie("email");
    session_destroy();
    header("Location: ../login.php");
    exit();
?>