<?php 
session_start();
include_once './classes/Admin.php';
$a=new Admin();
if (isset($_SESSION["email"])) {
    header("Location: ./admin/index.php");
    exit();
}

if(isset($_POST['submit'])){
    $admin = $a->checkLogin($_POST);
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
        $_SESSION["error"] = $error;
        header("Location: login.php");
        exit();
    }
    // Regular expression validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
        $_SESSION["error"] = $error;
        header("Location: login.php");
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9]{6,}$/", $password)) {
        $error = "Password must be at least 6 characters long and contain only letters and numbers.";
        $_SESSION["error"] = $error;
        header("Location: login.php");
        exit();
    }
    if($admin){
        extract($admin);
        $_SESSION["email"] = $admin_email_address;
        $_SESSION['admin_id'] = $admin_id;
        header("Location: ./admin/index.php");
        if (isset($_POST["remember"])) {
            setcookie("email", $email, time() + (86400 * 30)); // 86400 seconds = 1 day
        }

    }
    else {
        $error = "Invalid email or password.";
        $_SESSION["error"] = $error;
        header("Location: ../login.php");
        exit();
    }

}
?>