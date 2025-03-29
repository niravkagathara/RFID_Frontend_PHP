<?php
include_once '../classes/Student.php';

if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: students.php");
    exit();
}

$student = new Student();
$result = $student->deleteById($_GET['id']);

header("Location: students.php?success=".urlencode($result));
exit();
?>